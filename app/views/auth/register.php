<?php
$title = "Register - Car Rental System";
$additionalCSS = ['/css/auth-style.css'];
$additionalJS = ['js/auth.js'];

ob_start();
?>

<!-- Main Content -->
<div class="auth-container">
    <!-- VIP Logo/Brand -->
    <div class="vip-brand">
        <div class="logo-circle">
            <img src="/public/assets/logo-dark.png" alt="Car Rental System" class="vip-logo">
        </div>
        <h1 class="brand-title">PREMIUM CAR RENTAL</h1>
        <div class="brand-subtitle">Luxury • Comfort • Excellence</div>
    </div>
    
    <div class="form-section">
        <h2>Join VIP Club</h2>
        <p class="form-subtitle">Create your premium account and enjoy exclusive benefits</p>
      <!-- Error/Success message display -->
    <?php if (isset($errors) && !empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error): ?>
                <div><?= htmlspecialchars($error) ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    
    <?php if (isset($success)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>
    
    <form method="post" action="/auth/register" id="registerForm">
        <?php if (isset($_SESSION['csrf_token'])): ?>
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
        <?php endif; ?>
        
        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="full_name" class="form-control" required 
                   value="<?= htmlspecialchars($_POST['full_name'] ?? '') ?>">
            <div class="error-text" id="full_name-error"></div>
        </div>
        
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" class="form-control" required 
                   value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
            <div class="error-text" id="username-error"></div>
        </div>
        
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" class="form-control" required 
                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            <div class="error-text" id="email-error"></div>
        </div>
        
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone" class="form-control" 
                   value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
            <div class="error-text" id="phone-error"></div>
        </div>
        
        <div class="form-group">
            <label for="user_type">Account Type</label>            <select id="user_type" name="user_type" class="form-control" required>
                <option value="customer" <?= ($_POST['user_type'] ?? 'customer') === 'customer' ? 'selected' : '' ?>>Customer</option>
                <option value="rider" <?= ($_POST['user_type'] ?? '') === 'rider' ? 'selected' : '' ?>>Driver/Rider</option>
                <option value="owner" <?= ($_POST['user_type'] ?? '') === 'owner' ? 'selected' : '' ?>>Vehicle Owner</option>
            </select>
            <div class="error-text" id="user_type-error"></div>
        </div>
        
        <div class="form-group">
            <label for="password">Password</label>
            <div class="password-container">
                <input type="password" id="password" name="password" class="form-control" required>
                <button type="button" class="password-toggle" onclick="togglePassword('password')">
                    <i class="ri-eye-line"></i>
                </button>
            </div>
            <div class="error-text" id="password-error"></div>
        </div>
        
        <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <div class="password-container">
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                <button type="button" class="password-toggle" onclick="togglePassword('confirm_password')">
                    <i class="ri-eye-line"></i>
                </button>
            </div>
            <div class="error-text" id="confirm_password-error"></div>
        </div>
        
        <div class="form-group">
            <div class="form-check">
                <input type="checkbox" id="terms" name="terms" required>
                <label for="terms">I agree to the <a href="/terms" target="_blank">Terms and Conditions</a></label>
            </div>
            <div class="error-text" id="terms-error"></div>
        </div>
          <button type="submit" class="btn btn-primary btn-full">
            <span class="btn-text">Create VIP Account</span>
            <span class="btn-loading" style="display: none;">
                <i class="ri-loader-4-line spinning"></i> Creating Account...
            </span>
        </button>
    </form>
    
    </div> <!-- End form-section -->
    
    <div class="auth-links">
        <p>Already have an account? <a href="auth/login" class="login-link">Sign In to VIP</a></p>
        <p><a href="/Car-Rental-System/public/" class="home-link">← Back to Home</a></p>
    </div>
</div>

<!-- VIP Premium Auth Styles -->
<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap');

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
    min-height: 100vh;
    margin: 0;
    font-family: 'Inter', sans-serif;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow-x: hidden;
    padding: 1rem 0;
}

body::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: 
        radial-gradient(circle at 20% 80%, rgba(255, 215, 0, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255, 215, 0, 0.08) 0%, transparent 50%);
    pointer-events: none;
    z-index: 1;
}

.auth-container {
    max-width: 480px;
    width: 90%;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: 24px;
    box-shadow: 
        0 32px 64px rgba(0, 0, 0, 0.25),
        0 0 0 1px rgba(255, 215, 0, 0.1),
        inset 0 1px 0 rgba(255, 255, 255, 0.9);
    margin: 2rem auto;
    position: relative;
    z-index: 2;
    overflow: hidden;
}

.auth-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, transparent, #ffd700, transparent);
    z-index: 1;
}

.vip-brand {
    text-align: center;
    padding: 2.5rem 2rem 1.5rem;
    background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
    position: relative;
    margin: 0 0 2rem 0;
}

.vip-brand::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 2px;
    background: linear-gradient(90deg, transparent, #ffd700, transparent);
}

.logo-circle {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #ffd700, #ffed4e);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.2rem;
    box-shadow: 
        0 8px 32px rgba(255, 215, 0, 0.3),
        inset 0 2px 4px rgba(255, 255, 255, 0.3);
    position: relative;
}

.logo-circle::before {
    content: '';
    position: absolute;
    inset: 3px;
    border-radius: 50%;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), transparent);
    pointer-events: none;
}

.vip-logo {
    width: 45px;
    height: 45px;
    filter: brightness(0) invert(1);
    z-index: 1;
}

.brand-title {
    color: #ffd700;
    font-family: 'Playfair Display', serif;
    font-size: 1.3rem;
    font-weight: 700;
    letter-spacing: 2px;
    margin-bottom: 0.5rem;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.brand-subtitle {
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.85rem;
    font-weight: 300;
    letter-spacing: 1px;
}

.form-section {
    padding: 0 2rem 2rem;
}

.form-section h2 {
    text-align: center;
    font-family: 'Playfair Display', serif;
    font-size: 1.8rem;
    font-weight: 600;
    color: #1a1a2e;
    margin-bottom: 0.5rem;
}

.form-subtitle {
    text-align: center;
    color: #666;
    font-size: 0.9rem;
    margin-bottom: 1.5rem;
    font-weight: 300;
    line-height: 1.4;
}

.form-group {
    margin-bottom: 1.2rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
    color: #1a1a2e;
    font-size: 0.9rem;
    letter-spacing: 0.5px;
}

.form-control {
    width: 100%;
    padding: 0.9rem;
    border: 2px solid rgba(26, 26, 46, 0.1);
    border-radius: 12px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(10px);
    box-sizing: border-box;
}

.form-control:focus {
    outline: none;
    border-color: #ffd700;
    background: white;
    box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.1);
    transform: translateY(-1px);
}

select.form-control {
    cursor: pointer;
}

.password-container {
    position: relative;
}

.password-toggle {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #666;
    cursor: pointer;
    padding: 0;
    transition: color 0.3s ease;
}

.password-toggle:hover {
    color: #ffd700;
}

.form-check {
    display: flex;
    align-items: flex-start;
    gap: 0.5rem;
    margin-bottom: 0.5rem;
}

.form-check input[type="checkbox"] {
    accent-color: #ffd700;
    margin-top: 0.25rem;
}

.form-check label {
    margin-bottom: 0;
    font-size: 0.85rem;
    line-height: 1.4;
    color: #666;
}

.form-check label a {
    color: #ffd700;
    text-decoration: none;
    font-weight: 500;
}

.form-check label a:hover {
    text-decoration: underline;
}

.btn-primary {
    background: linear-gradient(135deg, #ffd700, #ffed4e);
    color: #1a1a2e;
    border: none;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 600;
    letter-spacing: 1px;
    text-transform: uppercase;
    position: relative;
    overflow: hidden;
}

.btn-primary::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transition: left 0.5s ease;
}

.btn-primary:hover::before {
    left: 100%;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 215, 0, 0.4);
}

.btn-full {
    width: 100%;
    padding: 1rem;
    font-size: 0.95rem;
    margin-top: 0.5rem;
}

.auth-links {
    text-align: center;
    margin-top: 1.5rem;
    padding: 0 2rem 2rem;
}

.auth-links p {
    margin: 0.75rem 0;
    color: #666;
    font-size: 0.9rem;
}

.login-link {
    color: #ffd700 !important;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    position: relative;
}

.login-link:hover {
    color: #ffed4e !important;
    text-shadow: 0 0 8px rgba(255, 215, 0, 0.5);
}

.home-link {
    color: #999 !important;
    text-decoration: none;
    font-size: 0.85rem;
    transition: all 0.3s ease;
}

.home-link:hover {
    color: #ffd700 !important;
}

.error-text {
    color: #dc3545;
    font-size: 0.8rem;
    margin-top: 0.5rem;
    display: none;
}

.alert {
    padding: 1rem;
    margin-bottom: 1.5rem;
    border: none;
    border-radius: 12px;
    backdrop-filter: blur(10px);
}

.alert-success {
    color: #0f5132;
    background: rgba(212, 237, 218, 0.9);
    border-left: 4px solid #0f5132;
}

.alert-danger {
    color: #842029;
    background: rgba(248, 215, 218, 0.9);
    border-left: 4px solid #842029;
}

.spinning {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

@media (max-width: 480px) {
    .auth-container {
        margin: 1rem;
        max-width: none;
    }
    
    .vip-brand {
        padding: 2rem 1.5rem 1.2rem;
    }
    
    .form-section {
        padding: 0 1.5rem 1.5rem;
    }
    
    .auth-links {
        padding: 0 1.5rem 1.5rem;
    }
    
    .brand-title {
        font-size: 1.1rem;
    }
    
    .logo-circle {
        width: 70px;
        height: 70px;
    }
    
    .vip-logo {
        width: 35px;
        height: 35px;
    }
    
    .form-section h2 {
        font-size: 1.6rem;
    }
    
    .form-group {
        margin-bottom: 1rem;
    }
}
</style>

<script>
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const toggle = field.nextElementSibling.querySelector('i');
    
    if (field.type === 'password') {
        field.type = 'text';
        toggle.className = 'ri-eye-off-line';
    } else {
        field.type = 'password';
        toggle.className = 'ri-eye-line';
    }
}

// Form validation
document.getElementById('registerForm').addEventListener('submit', function(e) {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    
    if (password !== confirmPassword) {
        e.preventDefault();
        const errorElement = document.getElementById('confirm_password-error');
        errorElement.textContent = 'Passwords do not match';
        errorElement.style.display = 'block';
        return false;
    }
    
    if (password.length < 6) {
        e.preventDefault();
        const errorElement = document.getElementById('password-error');
        errorElement.textContent = 'Password must be at least 6 characters long';
        errorElement.style.display = 'block';
        return false;
    }
});

// Clear error messages on input
document.querySelectorAll('.form-control').forEach(input => {
    input.addEventListener('input', function() {
        const errorElement = document.getElementById(this.name + '-error');
        if (errorElement) {
            errorElement.style.display = 'none';
        }
    });
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>
