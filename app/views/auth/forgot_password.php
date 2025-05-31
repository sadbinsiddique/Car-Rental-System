<?php
$title = "Forgot Password - Car Rental";
$showNavigation = false;
$showFooter = false;
$additionalCSS = ['css/forgot_password.css'];

ob_start();
?>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <img src="assets/logo-dark.png" alt="Car Rental Logo" class="auth-logo">
            <h2>পাসওয়ার্ড ভুলে গেছেন?</h2>
            <p>আপনার ইমেইল ঠিকানা প্রদান করুন, আমরা আপনাকে একটি OTP পাঠাবো।</p>
        </div>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?= $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <form action="auth/forgotPassword" method="POST" class="auth-form">
            <div class="form-group">
                <label for="email">ইমেইল ঠিকানা</label>
                <input type="email" id="email" name="email" required 
                       placeholder="আপনার ইমেইল ঠিকানা লিখুন"
                       value="<?= $_POST['email'] ?? '' ?>">
            </div>

            <button type="submit" class="btn btn-primary btn-full">
                OTP পাঠান <i class="ri-mail-send-line"></i>
            </button>
        </form>

        <div class="auth-links">
            <a href="auth/login" class="link-secondary">
                <i class="ri-arrow-left-line"></i> লগইনে ফিরে যান
            </a>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>
