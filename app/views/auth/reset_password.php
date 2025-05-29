<?php
$title = "Reset Password - Car Rental";
$showNavigation = false;
$showFooter = false;

ob_start();
?>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <img src="assets/logo-dark.png" alt="Car Rental Logo" class="auth-logo">
            <h2>নতুন পাসওয়ার্ড সেট করুন</h2>
            <p>একটি শক্তিশালী পাসওয়ার্ড বেছে নিন যা মনে রাখা সহজ কিন্তু অনুমান করা কঠিন।</p>
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

        <form action="/auth/resetPassword" method="POST" class="auth-form" id="resetForm">
            <div class="form-group">
                <label for="password">নতুন পাসওয়ার্ড</label>
                <div class="password-input">
                    <input type="password" id="password" name="password" required 
                           minlength="6" placeholder="কমপক্ষে ৬ অক্ষর">
                    <button type="button" class="password-toggle" onclick="togglePassword('password')">
                        <i class="ri-eye-line" id="password-icon"></i>
                    </button>
                </div>
                <div class="password-strength" id="password-strength"></div>
            </div>

            <div class="form-group">
                <label for="confirm_password">পাসওয়ার্ড নিশ্চিত করুন</label>
                <div class="password-input">
                    <input type="password" id="confirm_password" name="confirm_password" required 
                           minlength="6" placeholder="পাসওয়ার্ড আবার লিখুন">
                    <button type="button" class="password-toggle" onclick="togglePassword('confirm_password')">
                        <i class="ri-eye-line" id="confirm_password-icon"></i>
                    </button>
                </div>
                <div class="password-match" id="password-match"></div>
            </div>

            <button type="submit" class="btn btn-primary btn-full">
                পাসওয়ার্ড আপডেট করুন <i class="ri-save-line"></i>
            </button>
        </form>

        <div class="auth-links">
            <a href="/auth/login" class="link-secondary">
                <i class="ri-arrow-left-line"></i> লগইনে ফিরে যান
            </a>
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

.password-input {
    position: relative;
}

.password-input input {
    padding-right: 45px;
}

.password-toggle {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #666;
    cursor: pointer;
    font-size: 1.2rem;
}

.password-toggle:hover {
    color: #333;
}

.password-strength {
    margin-top: 5px;
    font-size: 0.8rem;
    height: 20px;
}

.password-match {
    margin-top: 5px;
    font-size: 0.8rem;
    height: 20px;
}

.strength-weak { color: #e53e3e; }
.strength-medium { color: #ff9800; }
.strength-strong { color: #4caf50; }

.match-success { color: #4caf50; }
.match-error { color: #e53e3e; }

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
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = document.getElementById(fieldId + '-icon');
    
    if (field.type === 'password') {
        field.type = 'text';
        icon.className = 'ri-eye-off-line';
    } else {
        field.type = 'password';
        icon.className = 'ri-eye-line';
    }
}

function checkPasswordStrength(password) {
    const strengthDiv = document.getElementById('password-strength');
    let strength = 0;
    let message = '';
    
    if (password.length >= 6) strength++;
    if (password.match(/[a-z]/)) strength++;
    if (password.match(/[A-Z]/)) strength++;
    if (password.match(/[0-9]/)) strength++;
    if (password.match(/[^a-zA-Z0-9]/)) strength++;
    
    if (strength < 2) {
        message = '<span class="strength-weak">দুর্বল পাসওয়ার্ড</span>';
    } else if (strength < 4) {
        message = '<span class="strength-medium">মাঝারি পাসওয়ার্ড</span>';
    } else {
        message = '<span class="strength-strong">শক্তিশালী পাসওয়ার্ড</span>';
    }
    
    strengthDiv.innerHTML = message;
}

function checkPasswordMatch() {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    const matchDiv = document.getElementById('password-match');
    
    if (confirmPassword === '') {
        matchDiv.innerHTML = '';
        return;
    }
    
    if (password === confirmPassword) {
        matchDiv.innerHTML = '<span class="match-success">✓ পাসওয়ার্ড মিলছে</span>';
    } else {
        matchDiv.innerHTML = '<span class="match-error">✗ পাসওয়ার্ড মিলছে না</span>';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const passwordField = document.getElementById('password');
    const confirmPasswordField = document.getElementById('confirm_password');
    
    passwordField.addEventListener('input', function() {
        checkPasswordStrength(this.value);
        checkPasswordMatch();
    });
    
    confirmPasswordField.addEventListener('input', checkPasswordMatch);
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>
