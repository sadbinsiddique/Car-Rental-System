<?php
$title = $data['title'] ?? 'Customer Dashboard';

// Start output buffering
ob_start();
?>

<div class="container mt-5">
    <h1><?= htmlspecialchars($data['welcome_message'] ?? 'Customer Dashboard'); ?></h1>
    <p>Welcome to your personal dashboard. Here you can manage your bookings, view your profile, and find new vehicles.</p>

    <div class="row mt-4">
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">My Bookings</h5>
                    <p class="card-text">View your past and current vehicle bookings.</p>
                    <a href="customer/bookings" class="btn btn-primary">View My Bookings</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">My Profile</h5>
                    <p class="card-text">Update your personal information and preferences.</p>
                    <a href="customer/profile" class="btn btn-primary">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Browse Vehicles</h5>
                    <p class="card-text">Explore available vehicles for your next trip.</p>
                    <a href="vehicles/browse" class="btn btn-success">Find a Car</a>
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
