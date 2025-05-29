<?php
$title = "Verify OTP - Car Rental";
$showNavigation = false;
$showFooter = false;

ob_start();
?>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <img src="assets/logo-dark.png" alt="Car Rental Logo" class="auth-logo">
            <h2>OTP যাচাই করুন</h2>
            <p>আমরা <strong><?= htmlspecialchars($email) ?></strong> এ একটি ৬ সংখ্যার কোড পাঠিয়েছি।</p>
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

        <form action="/auth/verifyOTP" method="POST" class="auth-form">
            <div class="form-group">
                <label for="otp">OTP কোড</label>
                <input type="text" id="otp" name="otp" required 
                       maxlength="6" pattern="[0-9]{6}"
                       placeholder="৬ সংখ্যার কোড লিখুন"
                       class="otp-input"
                       autocomplete="one-time-code">
            </div>

            <button type="submit" class="btn btn-primary btn-full">
                যাচাই করুন <i class="ri-shield-check-line"></i>
            </button>
        </form>

        <div class="auth-links">
            <a href="/auth/forgotPassword" class="link-secondary">
                <i class="ri-refresh-line"></i> নতুন OTP পাঠান
            </a>
            <br><br>
            <a href="/auth/login" class="link-secondary">
                <i class="ri-arrow-left-line"></i> লগইনে ফিরে যান
            </a>
        </div>

        <div class="otp-info">
            <p><i class="ri-time-line"></i> OTP এর মেয়াদ ১৫ মিনিট</p>
        </div>
    </div>
</div>

<style>
.auth-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 20px;
}

.auth-card {
    background: white;
    border-radius: 15px;
    padding: 40px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    width: 100%;
    max-width: 400px;
}

.auth-header {
    text-align: center;
    margin-bottom: 30px;
}

.auth-logo {
    height: 60px;
    margin-bottom: 20px;
}

.auth-header h2 {
    color: #333;
    margin-bottom: 10px;
    font-size: 1.8rem;
}

.auth-header p {
    color: #666;
    font-size: 0.9rem;
}

.otp-input {
    text-align: center;
    font-size: 1.5rem;
    font-weight: bold;
    letter-spacing: 0.5rem;
    background: #f8f9ff;
}

.otp-info {
    text-align: center;
    margin-top: 20px;
    padding: 10px;
    background: #f8f9ff;
    border-radius: 8px;
    color: #666;
    font-size: 0.85rem;
}

.alert {
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-size: 0.9rem;
}

.alert-error {
    background: #fee;
    color: #c53030;
    border: 1px solid #fecaca;
}

.alert-success {
    background: #f0fff4;
    color: #2d7d32;
    border: 1px solid #c6f6d5;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    color: #333;
    font-weight: 500;
}

.form-group input {
    width: 100%;
    padding: 12px;
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
}

.form-group input:focus {
    outline: none;
    border-color: #667eea;
}

.btn {
    padding: 12px 24px;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
}

.btn-full {
    width: 100%;
    justify-content: center;
}

.auth-links {
    text-align: center;
    margin-top: 20px;
}

.link-secondary {
    color: #666;
    text-decoration: none;
    font-size: 0.9rem;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.link-secondary:hover {
    color: #333;
}
</style>

<script>
// Auto-focus OTP input and format
document.addEventListener('DOMContentLoaded', function() {
    const otpInput = document.getElementById('otp');
    otpInput.focus();
    
    // Only allow numbers
    otpInput.addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
        if (this.value.length === 6) {
            // Auto-submit when 6 digits entered
            this.form.submit();
        }
    });
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>
