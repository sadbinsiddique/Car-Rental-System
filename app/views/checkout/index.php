<?php
// filepath: c:\xampp\htdocs\Car-Rental-System\app\views\checkout\index.php

$additionalCSS = ['/css/checkout-style.css']; // Optional: Add specific CSS for checkout styling

// Start output buffering
ob_start();
?>

<div class="checkout-container">
    <h1><i class="ri-shopping-cart-line"></i> Secure Checkout</h1>

    <?php if (isset($_SESSION['flash_message'])) : ?>
        <div class="alert alert-<?= htmlspecialchars($_SESSION['flash_message']['type']) ?>">
            <?= htmlspecialchars($_SESSION['flash_message']['message']) ?>
        </div>
        <?php unset($_SESSION['flash_message']); ?>
    <?php endif; ?>

    <?php if (!empty($error_message)) : ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($error_message) ?>
        </div>
    <?php endif; ?>

    <?php if ($vehicle) : ?>
        <div class="vehicle-summary">
            <h2>Selected Vehicle</h2>
            <div class="vehicle-details">
                <?php if (!empty($vehicle['photos'])):
                    $photos = json_decode($vehicle['photos'], true);
                    $imagePath = BASE_URL . '/' . ($photos[0] ?? 'assets/images/default-car.png');
                ?>
                    <img src="<?= htmlspecialchars($imagePath) ?>" alt="<?= htmlspecialchars($vehicle['name']) ?>" class="vehicle-image">
                <?php else: ?>
                    <img src="<?= BASE_URL ?>/assets/images/default-car.png" alt="Default Car Image" class="vehicle-image">
                <?php endif; ?>
                <div>
                    <h3><?= htmlspecialchars($vehicle['name']) ?></h3>
                    <p><?= htmlspecialchars($vehicle['brand']) ?> <?= htmlspecialchars($vehicle['model']) ?> (<?= htmlspecialchars($vehicle['year']) ?>)</p>
                    <p>Type: <?= htmlspecialchars(ucfirst($vehicle['vehicle_type'])) ?></p>
                    <p>Base Location: <?= htmlspecialchars($vehicle['location']) ?></p>
                    <p>Cost per KM: $<?= htmlspecialchars(number_format($vehicle['cost_per_km'], 2)) ?></p>
                </div>
            </div>
        </div>

        <form action="<?= BASE_URL ?>/checkout/index/<?= $vehicle_id ?>" method="POST" class="checkout-form">
            <input type="hidden" name="vehicle_id" value="<?= htmlspecialchars($vehicle_id) ?>">
            <input type="hidden" name="action" value="calculate_price"> <!-- To trigger calculation -->

            <h2><i class="ri-map-pin-line"></i> Rental Details</h2>
            
            <div class="form-group">
                <label for="pickup_location">Pickup Location:</label>
                <input type="text" id="pickup_location" name="pickup_location" value="<?= htmlspecialchars($pickup_location) ?>" required>
                <small>E.g., "Airport", "Downtown Station", "<?= htmlspecialchars($vehicle['location']) ?>"</small>
            </div>

            <div class="form-group">
                <label for="dropoff_location">Drop-off Location:</label>
                <input type="text" id="dropoff_location" name="dropoff_location" value="<?= htmlspecialchars($dropoff_location) ?>" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="pickup_date">Pickup Date & Time:</label>
                    <input type="datetime-local" id="pickup_date" name="pickup_date" value="<?= htmlspecialchars($pickup_date) ?>" required>
                </div>
                <div class="form-group">
                    <label for="dropoff_date">Drop-off Date & Time:</label>
                    <input type="datetime-local" id="dropoff_date" name="dropoff_date" value="<?= htmlspecialchars($dropoff_date) ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label for="distance_km">Estimated Distance (km):</label>
                <input type="number" id="distance_km" name="distance_km" step="0.1" min="1" value="<?= htmlspecialchars($distance_km) ?>" required>
                <small>This will be used to calculate the base price.</small>
            </div>
            
            <button type="submit" name="calculate_price_btn" class="btn btn-info btn-block"><i class="ri-calculator-line"></i> Calculate Price</button>
        </form>

        <?php if (isset($calculated_price) && is_numeric($calculated_price)) : ?>
            <div class="price-summary">
                <h3>Estimated Total Price:</h3>
                <p class="total-price">$<?= htmlspecialchars(number_format($calculated_price, 2)) ?></p>
                <small>This price includes base fare and location-based surcharges. Other fees might apply.</small>
            </div>
            
            <!-- Form to proceed with booking --> 
            <form action="<?= BASE_URL ?>/checkout/processBooking" method="POST" class="booking-confirmation-form">
                <input type="hidden" name="vehicle_id" value="<?= htmlspecialchars($vehicle_id) ?>">
                <input type="hidden" name="pickup_location" value="<?= htmlspecialchars($pickup_location) ?>">
                <input type="hidden" name="dropoff_location" value="<?= htmlspecialchars($dropoff_location) ?>">
                <input type="hidden" name="pickup_date" value="<?= htmlspecialchars($pickup_date) ?>">
                <input type="hidden" name="dropoff_date" value="<?= htmlspecialchars($dropoff_date) ?>">
                <input type="hidden" name="distance_km" value="<?= htmlspecialchars($distance_km) ?>">
                <input type="hidden" name="final_price" value="<?= htmlspecialchars($calculated_price) ?>">
                
                <button type="submit" name="confirm_booking_btn" class="btn btn-primary btn-block btn-lg"><i class="ri-check-double-line"></i> Confirm & Proceed to Book</button>
            </form>
        <?php elseif (isset($calculated_price)): // Error message from calculation ?>
             <div class="alert alert-warning">
                Price Calculation: <?= htmlspecialchars($calculated_price) ?>
            </div>
        <?php endif; ?>

    <?php else: ?>
        <p>Please select a vehicle from the showroom to proceed with checkout.</p>
        <a href="<?= BASE_URL ?>/home" class="btn btn-secondary">Go to Showroom</a>
    <?php endif; ?>

</div>

<?php
// Get the buffered content and assign it to $content
$content = ob_get_clean();

// Include the main layout
require_once __DIR__ . '/../layouts/main.php';
?>
