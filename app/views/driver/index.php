<?php
$title = $data['title'] ?? 'Driver Dashboard';

// Start output buffering
ob_start();
?>

<div class="container mt-5">
    <h1><?= htmlspecialchars($data['welcome_message'] ?? 'Driver Dashboard'); ?></h1>
    <p>Manage your assigned trips, update your availability, and view your earnings.</p>

    <div class="row mt-4">
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Assigned Trips</h5>
                    <p class="card-text">View and manage your current and upcoming trips.</p>
                    <a href="driver/trips" class="btn btn-primary">My Trips</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">My Availability</h5>
                    <p class="card-text">Set and update your working hours and availability status.</p>
                    <a href="driver/availability" class="btn btn-primary">Update Availability</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Earnings</h5>
                    <p class="card-text">View your earnings reports and payment history.</p>
                    <a href="driver/earnings" class="btn btn-info">View Earnings</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Vehicle Information</h5>
                    <p class="card-text">Manage information about the vehicle you operate.</p>
                    <a href="driver/vehicle" class="btn btn-secondary">My Vehicle</a>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
// Get the buffered content and assign it to $content
$content = ob_get_clean();

// Include the main layout
include __DIR__ . '/../layouts/main.php';
?>
