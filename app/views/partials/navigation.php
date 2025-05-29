<header>
    <nav>
        <div class="nav__header">            <div class="nav__logo">
                <a href="/" class="logo">
                    <img src="assets/logo-white.png" alt="logo" class="logo-white" />
                    <img src="assets/logo-dark.png" alt="logo" class="logo-dark" />
                    <span>Car Rental</span>
                </a>
            </div>
            <div class="nav__menu__btn" id="menu-btn">
                <i class="ri-menu-line"></i>
            </div>
        </div>
        <ul class="nav__links" id="nav-links">
            <li><a href="/" class="<?= ($currentPage ?? '') === 'home' ? 'active' : '' ?>">Home</a></li>
            <li><a href="/#about">About</a></li>
            <li><a href="/#deals">Rental Deals</a></li>
            <li><a href="/#choose">Why Choose Us</a></li>
            <li><a href="/#client">Testimonials</a></li>
            
            <?php if (isset($_SESSION['user_id'])): ?>
                <!-- Authenticated user navigation -->
                <li><a href="/dashboard" class="<?= ($currentPage ?? '') === 'dashboard' ? 'active' : '' ?>">Dashboard</a></li>
                <?php if ($_SESSION['role'] === 'vehicle_owner'): ?>
                    <li><a href="/vehicles/my-vehicles">My Vehicles</a></li>
                <?php endif; ?>
                <?php if ($_SESSION['role'] === 'customer'): ?>
                    <li><a href="/bookings/my-bookings">My Bookings</a></li>
                <?php endif; ?>
                <?php if ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'super_admin'): ?>
                    <li><a href="/admin">Admin Panel</a></li>
                <?php endif; ?>
            <?php else: ?>
                <!-- Guest navigation -->
                <li><a href="/auth/register" class="<?= ($currentPage ?? '') === 'register' ? 'active' : '' ?>">Register</a></li>
            <?php endif; ?>
        </ul>
        <div class="nav__btns">
            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="user-info">
                    <span class="user-greeting">Hello, <?= htmlspecialchars($_SESSION['username'] ?? 'User') ?></span>
                    <a href="/auth/logout" class="btn btn-outline">Logout</a>
                </div>
            <?php else: ?>
                <a href="/auth/login" class="btn btn-outline">Login</a>
                <a href="/auth/register" class="btn">Sign Up</a>
            <?php endif; ?>
        </div>
    </nav>
</header>
