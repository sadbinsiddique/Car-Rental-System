<?php
$title = "Admin Dashboard - Car Rental System";
// Use a relative path from the public directory for CSS files
$additionalCSS = ['/css/admin-dashboard.css']; 

// Start output buffering
ob_start();
?>

<div class="admin-dashboard-container">
    <header class="dashboard-header">
        <h1>Admin Dashboard</h1>
        <p>Welcome, <?= htmlspecialchars($_SESSION['user_first_name'] ?? 'Admin') ?>!</p>
    </header>

    <?php if (isset($_SESSION['flash_message'])): ?>
        <div class="alert alert-<?= htmlspecialchars($_SESSION['flash_message']['type']) ?>">
            <?= htmlspecialchars($_SESSION['flash_message']['message']) ?>
        </div>
        <?php unset($_SESSION['flash_message']); ?>
    <?php endif; ?>

    <div class="dashboard-sections">
        <!-- User Management Section -->
        <section class="dashboard-section">
            <h2><i class="ri-group-line"></i> User Management</h2>
            <ul class="management-links">
                <li><a href="<?= BASE_URL ?>/admin/users" class="btn btn-secondary">List All Users</a></li>
                <li><a href="<?= BASE_URL ?>/admin/users/create" class="btn btn-primary">Register New User</a></li>
                <li><a href="<?= BASE_URL ?>/admin/drivers/create" class="btn btn-primary">Register New Driver</a></li>
                <li><a href="<?= BASE_URL ?>/admin/owners/create" class="btn btn-primary">Register New Owner</a></li>
            </ul>
        </section>

        <!-- Vehicle Management Section -->
        <section class="dashboard-section">
            <h2><i class="ri-roadster-line"></i> Vehicle Management</h2>
            <ul class="management-links">
                <li><a href="<?= BASE_URL ?>/admin/vehicles" class="btn btn-secondary">List All Vehicles</a></li>
                <li><a href="<?= BASE_URL ?>/admin/vehicles/create" class="btn btn-primary">Register New Car</a></li>
            </ul>
        </section>

        <!-- Booking Management Section -->
        <section class="dashboard-section">
            <h2><i class="ri-calendar-check-line"></i> Booking Management</h2>
            <ul class="management-links">
                <li><a href="<?= BASE_URL ?>/admin/bookings" class="btn btn-secondary">List All Bookings</a></li>
                <!-- Add links for managing bookings as needed -->
            </ul>
        </section>
        
        <!-- Other sections like Reports, Settings can be added here -->
    </div>
</div>

<?php
// Get the buffered content and assign it to $content
$content = ob_get_clean();

// Include the main layout
include __DIR__ . '/../layouts/main.php';
?>
