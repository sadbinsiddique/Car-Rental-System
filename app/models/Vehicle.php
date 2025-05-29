<?php

namespace app\models;

use app\core\Model;

class Vehicle extends Model {
    protected $table = 'vehicles';

    // Add findById method
    public function findById($id) {
        return $this->db->fetch("SELECT * FROM {$this->table} WHERE id = ?", [$id]);
    }

    public function getFeaturedVehicles($limit = 6) {
        try {
            return $this->db->fetchAll(
                "SELECT v.*, AVG(r.rating) as avg_rating, COUNT(r.id) as review_count,
                        u.full_name as owner_name
                 FROM vehicles v 
                 LEFT JOIN ratings r ON v.id = r.rated_id AND r.rated_type = 'vehicle'
                 LEFT JOIN users u ON v.owner_id = u.id
                 WHERE v.status = 'approved' 
                 AND (v.is_available IS NULL OR v.is_available = 1)
                 GROUP BY v.id 
                 ORDER BY avg_rating DESC, v.created_at DESC
                 LIMIT ?",
                [$limit]
            );
        } catch (Exception $e) {
            // Fallback query if new columns don't exist
            return $this->db->fetchAll(
                "SELECT v.*, u.full_name as owner_name
                 FROM vehicles v 
                 LEFT JOIN users u ON v.owner_id = u.id
                 WHERE v.status = 'approved' 
                 ORDER BY v.created_at DESC
                 LIMIT ?",
                [$limit]
            );
        }
    }

    public function getPopularBrands() {
        return $this->db->fetchAll(
            "SELECT make as brand, COUNT(*) as count 
             FROM vehicles 
             WHERE status = 'approved' 
             GROUP BY make 
             ORDER BY count DESC
             LIMIT 5"
        );
    }    public function getAvailableVehicles($limit = 10) {
        try {
            return $this->db->fetchAll(
                "SELECT v.*, AVG(r.rating) as avg_rating, COUNT(r.id) as review_count
                 FROM vehicles v 
                 LEFT JOIN ratings r ON v.id = r.rated_id AND r.rated_type = 'vehicle'
                 WHERE v.status = 'approved' 
                 AND (v.is_available IS NULL OR v.is_available = 1)
                 GROUP BY v.id 
                 ORDER BY avg_rating DESC 
                 LIMIT ?",
                [$limit]
            );
        } catch (Exception $e) {
            // Fallback query
            return $this->db->fetchAll(
                "SELECT v.*
                 FROM vehicles v 
                 WHERE v.status = 'approved' 
                 ORDER BY v.created_at DESC
                 LIMIT ?",
                [$limit]
            );
        }
    }    public function searchVehicles($params) {
        try {
            $sql = "SELECT v.*, AVG(r.rating) as avg_rating, COUNT(r.id) as review_count
                    FROM vehicles v 
                    LEFT JOIN ratings r ON v.id = r.rated_id AND r.rated_type = 'vehicle'
                    WHERE v.status = 'approved' 
                    AND (v.is_available IS NULL OR v.is_available = 1)";
        } catch (Exception $e) {
            // Fallback query
            $sql = "SELECT v.*
                    FROM vehicles v 
                    WHERE v.status = 'approved'";
        }
        
        $conditions = [];
        $sqlParams = [];

        if (!empty($params['location'])) {
            $conditions[] = "v.location LIKE ?";
            $sqlParams[] = '%' . $params['location'] . '%';
        }

        if (!empty($params['vehicle_type'])) {
            $conditions[] = "v.vehicle_type = ?";
            $sqlParams[] = $params['vehicle_type'];
        }        // Check availability for date range
        if (!empty($params['pickup_date']) && !empty($params['dropoff_date'])) {
            $conditions[] = "v.id NOT IN (
                SELECT DISTINCT vehicle_id FROM bookings 
                WHERE booking_status IN ('confirmed', 'in_progress') 
                AND (
                    (start_date <= ? AND end_date >= ?) OR
                    (start_date <= ? AND end_date >= ?) OR
                    (start_date >= ? AND end_date <= ?)
                )
            )";
            $sqlParams = array_merge($sqlParams, [
                $params['pickup_date'], $params['pickup_date'],
                $params['dropoff_date'], $params['dropoff_date'],
                $params['pickup_date'], $params['dropoff_date']
            ]);
        }

        if (!empty($conditions)) {
            $sql .= " AND " . implode(" AND ", $conditions);
        }

        $sql .= " GROUP BY v.id ORDER BY rating DESC, v.total_bookings DESC";

        return $this->db->fetchAll($sql, $sqlParams);
    }

    public function createVehicle($data) {
        $vehicleData = [
            'owner_id' => $data['owner_id'],
            'name' => $data['name'],
            'brand' => $data['brand'],
            'model' => $data['model'],
            'year' => $data['year'],
            'vehicle_type' => $data['vehicle_type'],
            'license_plate' => $data['license_plate'],
            'color' => $data['color'],
            'seats' => $data['seats'],
            'transmission' => $data['transmission'],
            'fuel_type' => $data['fuel_type'],
            'mileage' => $data['mileage'],
            'cost_per_km' => $data['cost_per_km'],
            'max_speed' => $data['max_speed'] ?? null,
            'location' => $data['location'],
            'features' => isset($data['features']) ? json_encode($data['features']) : null,
            'status' => 'pending'
        ];

        // Handle photo uploads
        if (isset($_FILES['photos'])) {
            $photos = $this->uploadVehiclePhotos($_FILES['photos']);
            if ($photos) {
                $vehicleData['photos'] = json_encode($photos);
            }
        }

        // Handle license document upload
        if (isset($_FILES['license_document']) && $_FILES['license_document']['error'] === 0) {
            $uploadDir = '../uploads/vehicle_licenses/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            
            $fileName = time() . '_' . $_FILES['license_document']['name'];
            $uploadPath = $uploadDir . $fileName;
            
            if (move_uploaded_file($_FILES['license_document']['tmp_name'], $uploadPath)) {
                $vehicleData['license_document'] = $fileName;
            }
        }

        return $this->create($vehicleData);
    }

    public function getOwnerVehicles($ownerId) {
        return $this->db->fetchAll(
            "SELECT v.*, AVG(r.vehicle_rating) as rating, COUNT(r.id) as review_count
             FROM vehicles v 
             LEFT JOIN ratings r ON v.id = r.vehicle_id 
             WHERE v.owner_id = ? 
             GROUP BY v.id 
             ORDER BY v.created_at DESC",
            [$ownerId]
        );
    }

    public function getOwnerTotalBookings($ownerId) {
        $result = $this->db->fetch(
            "SELECT COUNT(*) as count 
             FROM bookings b 
             JOIN vehicles v ON b.vehicle_id = v.id 
             WHERE v.owner_id = ?",
            [$ownerId]
        );
        return $result['count'];
    }

    public function getOwnerTotalRevenue($ownerId) {
        $result = $this->db->fetch(
            "SELECT SUM(b.final_price) as total 
             FROM bookings b 
             JOIN vehicles v ON b.vehicle_id = v.id 
             WHERE v.owner_id = ? AND b.status = 'completed'",
            [$ownerId]
        );
        return $result['total'] ?? 0;
    }

    public function getOwnerRecentBookings($ownerId, $limit) {
        return $this->db->fetchAll(
            "SELECT b.*, v.name as vehicle_name, u.full_name as customer_name
             FROM bookings b 
             JOIN vehicles v ON b.vehicle_id = v.id 
             JOIN users u ON b.customer_id = u.id
             WHERE v.owner_id = ? 
             ORDER BY b.created_at DESC 
             LIMIT ?",
            [$ownerId, $limit]
        );
    }

    public function approveVehicle($vehicleId, $adminId) {
        $result = $this->update($vehicleId, ['status' => 'approved']);
        
        if ($result) {
            // Notify owner
            $vehicle = $this->findById($vehicleId);
            $this->createNotification(
                $vehicle['owner_id'],
                'Vehicle Approved',
                'Your vehicle has been approved and is now available for booking.',
                'system',
                $vehicleId
            );
            
            // Log audit event
            $userModel = new User();
            $userModel->logAuditEvent($adminId, 'vehicle_approved', 'vehicles', $vehicleId);
        }
        
        return $result;
    }

    public function rejectVehicle($vehicleId, $adminId, $reason = '') {
        $result = $this->update($vehicleId, ['status' => 'rejected']);
        
        if ($result) {
            // Notify owner
            $vehicle = $this->findById($vehicleId);
            $this->createNotification(
                $vehicle['owner_id'],
                'Vehicle Rejected',
                "Your vehicle has been rejected. Reason: $reason",
                'system',
                $vehicleId
            );
            
            // Log audit event
            $userModel = new User();
            $userModel->logAuditEvent($adminId, 'vehicle_rejected', 'vehicles', $vehicleId, null, ['reason' => $reason]);
        }
        
        return $result;
    }

    public function updateVehicleRating($vehicleId) {
        $result = $this->db->fetch(
            "SELECT AVG(vehicle_rating) as avg_rating 
             FROM ratings 
             WHERE vehicle_id = ?",
            [$vehicleId]
        );
        
        $rating = round($result['avg_rating'] ?? 0, 2);
        return $this->update($vehicleId, ['rating' => $rating]);
    }

    private function uploadVehiclePhotos($files) {
        $uploadDir = '../uploads/vehicles/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $uploadedPhotos = [];
        
        // Handle multiple file upload
        if (is_array($files['name'])) {
            for ($i = 0; $i < count($files['name']); $i++) {
                if ($files['error'][$i] === 0) {
                    $fileName = time() . '_' . $i . '_' . $files['name'][$i];
                    $uploadPath = $uploadDir . $fileName;
                    
                    if (move_uploaded_file($files['tmp_name'][$i], $uploadPath)) {
                        $uploadedPhotos[] = $fileName;
                    }
                }
            }
        } else {
            // Single file upload
            if ($files['error'] === 0) {
                $fileName = time() . '_' . $files['name'];
                $uploadPath = $uploadDir . $fileName;
                
                if (move_uploaded_file($files['tmp_name'], $uploadPath)) {
                    $uploadedPhotos[] = $fileName;
                }
            }
        }

        return $uploadedPhotos;
    }

    private function createNotification($userId, $title, $message, $type, $relatedId = null) {
        return $this->db->insert('notifications', [
            'user_id' => $userId,
            'title' => $title,
            'message' => $message,
            'type' => $type,
            'related_id' => $relatedId
        ]);
    }

    public function getTotalApprovedVehicles() {
        $result = $this->db->fetch("SELECT COUNT(*) as count FROM vehicles WHERE status = 'approved'");
        return $result['count'];
    }
}
