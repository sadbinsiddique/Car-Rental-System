<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Vehicle;
use app\models\User; // Assuming you might need user details

class CheckoutController extends Controller {

    public function __construct() {
        // parent::__construct(); // If you have a base controller constructor
        // Implement authentication checks if necessary
        // For example, only logged-in users can access checkout
        if (!isset($_SESSION['user_id'])) {
            $this->setFlash('error', 'You must be logged in to proceed to checkout.');
            $this->redirect('/auth/login');
            exit;
        }
    }

    public function index($vehicle_id = null) {
        $data = [
            'title' => 'Checkout',
            'vehicle' => null,
            'vehicle_id' => $vehicle_id,
            'pickup_location' => '',
            'dropoff_location' => '',
            'pickup_date' => '',
            'dropoff_date' => '',
            'distance_km' => '', // User might input this or it could be calculated
            'calculated_price' => null,
            'error_message' => null
        ];

        if ($vehicle_id) {
            $vehicleModel = new Vehicle();
            $data['vehicle'] = $vehicleModel->findById($vehicle_id); // Assuming findById exists
            if (!$data['vehicle']) {
                $this->setFlash('error', 'Selected vehicle not found.');
                // Potentially redirect or handle error appropriately
                $data['error_message'] = 'Vehicle not found.';
            }
        } else {
            // Handle case where no vehicle ID is provided, maybe redirect to selection page
            $this->setFlash('info', 'Please select a vehicle to proceed to checkout.');
            // $this->redirect('/showroom'); // Or wherever vehicles are listed
            // For now, let's allow the page to load but show a message
            $data['error_message'] = 'No vehicle selected for checkout.';
        }
        
        // Pre-fill form if data is in session or POST request (e.g., from a previous step)
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'calculate_price') {
            // Handle price calculation - this will be expanded
            $data = array_merge($data, $_POST);
            $calculatedPrice = $this->calculateRentalPrice($_POST);
            if (is_numeric($calculatedPrice)) {
                $data['calculated_price'] = $calculatedPrice;
            } else {
                $data['error_message'] = $calculatedPrice; // Assuming calculateRentalPrice returns error string
            }
        }


        $this->view('checkout/index', $data);
    }

    /**
     * Calculate rental price based on vehicle, distance, duration, and location factors.
     * This is a placeholder and will need significant expansion.
     */
    public function calculateRentalPrice($params) {
        if (empty($params['vehicle_id']) || empty($params['distance_km']) || empty($params['pickup_date']) || empty($params['dropoff_date'])) {
            return "Missing required parameters for price calculation.";
        }

        $vehicleModel = new Vehicle();
        $vehicle = $vehicleModel->findById($params['vehicle_id']);

        if (!$vehicle) {
            return "Vehicle not found.";
        }

        $distance = floatval($params['distance_km']);
        if ($distance <= 0) {
            return "Distance must be a positive value.";
        }

        // Basic price: distance * cost_per_km
        $basePrice = $distance * floatval($vehicle['cost_per_km']);

        // Duration calculation (simplified)
        $pickupDate = new \DateTime($params['pickup_date']);
        $dropoffDate = new \DateTime($params['dropoff_date']);
        if ($dropoffDate <= $pickupDate) {
            return "Drop-off date must be after pickup date.";
        }
        $durationDays = $dropoffDate->diff($pickupDate)->days;
        if ($durationDays < 1) $durationDays = 1; // Minimum 1 day rental for simplicity

        // Price per day (if applicable, or adjust cost_per_km logic)
        // For now, let's assume cost_per_km covers the daily aspect or it's a per-trip cost.
        // If there's a daily rate, it should be in the vehicles table.
        // $totalPrice = $durationDays * $vehicle['daily_rate'] + $basePrice; (Example)
        $totalPrice = $basePrice; // Simplified for now

        // Location-based surcharge (placeholder)
        $locationSurcharge = 0;
        if (strtolower($params['pickup_location']) === 'airport' || strtolower($params['dropoff_location']) === 'airport') {
            $locationSurcharge += 50; // Example airport surcharge
        }
        if (strtolower($params['pickup_location']) !== strtolower($vehicle['location'])) {
            // Potentially add a surcharge if pickup is far from vehicle's base
            // $locationSurcharge += 20; 
        }
        
        $totalPrice += $locationSurcharge;

        // Add other factors: insurance, add-ons, taxes, etc.

        return round($totalPrice, 2);
    }
    
    // Method to handle the actual booking submission
    public function processBooking() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/checkout'); // Or appropriate error page
            return;
        }

        // Validate input (vehicle_id, pickup_location, dropoff_location, dates, etc.)
        // Calculate final price again to ensure consistency
        // Create booking record in the database
        // Redirect to payment or confirmation page
        
        // Example data retrieval from POST
        $vehicle_id = $_POST['vehicle_id'] ?? null;
        $pickup_location = $_POST['pickup_location'] ?? '';
        $dropoff_location = $_POST['dropoff_location'] ?? '';
        $pickup_date = $_POST['pickup_date'] ?? '';
        $dropoff_date = $_POST['dropoff_date'] ?? '';
        $distance_km = $_POST['distance_km'] ?? 0;
        // ... other fields ...

        if (!$vehicle_id /*... other validation ...*/) {
            $this->setFlash('error', 'Invalid booking details.');
            $this->redirect('/checkout/index/' . $vehicle_id); // Redirect back with vehicle_id
            return;
        }
        
        $finalPrice = $this->calculateRentalPrice($_POST);
        if (!is_numeric($finalPrice)) {
            $this->setFlash('error', 'Could not calculate price: ' . $finalPrice);
            $this->redirect('/checkout/index/' . $vehicle_id);
            return;
        }

        // Assume BookingModel exists and has a createBooking method
        // $bookingModel = new BookingModel();
        // $bookingData = [
        // 'customer_id' => $_SESSION['user_id'],
        // 'vehicle_id' => $vehicle_id,
        // 'pickup_location' => $pickup_location,
        // ...
        // 'final_price' => $finalPrice,
        // 'status' => 'pending' // Initial status
        // ];
        // $booking_id = $bookingModel->createBooking($bookingData);

        // if ($booking_id) {
        // $this->setFlash('success', 'Booking initiated! Please proceed to payment.');
        // $this->redirect('/payment/process/' . $booking_id);
        // } else {
        // $this->setFlash('error', 'Failed to create booking. Please try again.');
        // $this->redirect('/checkout/index/' . $vehicle_id);
        // }
        
        // For now, just show the calculated price and a success message
        $this->setFlash('success', 'Booking details processed. Calculated Price: $' . $finalPrice . '. Payment integration is pending.');
        $this->redirect('/checkout/index/' . $vehicle_id . '?price=' . $finalPrice);


    }

}
