<?php
$title = "Login - Car Rental System";
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
        <h2>Welcome Back</h2>
        <p class="form-subtitle">Sign in to your premium account</p>
      <!-- Error/Success message display -->
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    
    <?php if (isset($success)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>
    
    <form method="post" action="auth/login" id="loginForm">
        <?php if (isset($_SESSION['csrf_token'])): ?>
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
        <?php endif; ?>
          <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" class="form-control" required 
                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            <div class="error-text" id="email-error"></div>
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
          <div class="form-group-row">
            <div class="form-check">
                <input type="checkbox" id="remember" name="remember" value="1">
                <label for="remember">Remember me</label>
            </div>
            <div class="forgot-password">
                <a href="auth/forgotPassword">Forgot Password?</a>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary btn-full">
            <span class="btn-text">Login</span>
            <span class="btn-loading" style="display: none;">
                <i class="ri-loader-4-line spinning"></i> Logging in...
            </span>        </button>
    </form>
    
    </div> <!-- End form-section -->
    
    <div class="auth-links">
        <p>Don't have an account? <a href="auth/register" class="register-link">Create Premium Account</a></p>
        <p><a href="/Car-Rental-System/public/" class="home-link">← Back to Home</a></p>
    </div>
    
    <!-- Social Login (if needed in future) -->
    <div class="social-login" style="display: none;">
        <div class="divider">
            <span>Or continue with</span>
        </div>
        <div class="social-buttons">
            <button class="btn btn-social btn-google">
                <i class="ri-google-fill"></i> Google
            </button>
            <button class="btn btn-social btn-facebook">
                <i class="ri-facebook-fill"></i> Facebook
            </button>
        </div>
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
    max-width: 420px;
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
    padding: 3rem 2rem 2rem;
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
    width: 90px;
    height: 90px;
    background: linear-gradient(135deg, #ffd700, #ffed4e);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
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
    width: 50px;
    height: 50px;
    filter: brightness(0) invert(1);
    z-index: 1;
}

.brand-title {
    color: #ffd700;
    font-family: 'Playfair Display', serif;
    font-size: 1.4rem;
    font-weight: 700;
    letter-spacing: 2px;
    margin-bottom: 0.5rem;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.brand-subtitle {
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.9rem;
    font-weight: 300;
    letter-spacing: 1px;
}

.form-section {
    padding: 0 2rem 2rem;
}

.form-section h2 {
    text-align: center;
    font-family: 'Playfair Display', serif;
    font-size: 2rem;
    font-weight: 600;
    color: #1a1a2e;
    margin-bottom: 0.5rem;
}

.form-subtitle {
    text-align: center;
    color: #666;
    font-size: 0.95rem;
    margin-bottom: 2rem;
    font-weight: 300;
}

.form-group {
    margin-bottom: 1.5rem;
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
    padding: 1rem;
    border: 2px solid rgba(26, 26, 46, 0.1);
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(10px);
}

.form-control:focus {
    outline: none;
    border-color: #ffd700;
    background: white;
    box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.1);
    transform: translateY(-1px);
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

.form-group-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.form-check {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.form-check input[type="checkbox"] {
    accent-color: #ffd700;
}

.forgot-password a {
    color: #ffd700;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.forgot-password a:hover {
    color: #ffed4e;
    text-shadow: 0 0 8px rgba(255, 215, 0, 0.5);
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
    font-size: 1rem;
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

.register-link {
    color: #ffd700 !important;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    position: relative;
}

.register-link:hover {
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
    font-size: 0.85rem;
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
        padding: 2rem 1.5rem 1.5rem;
    }
    
    .form-section {
        padding: 0 1.5rem 1.5rem;
    }
    
    .auth-links {
        padding: 0 1.5rem 1.5rem;
    }
    
    .form-group-row {
        flex-direction: column;
        gap: 1rem;
        align-items: stretch;
    }
    
    .brand-title {
        font-size: 1.2rem;
    }
    
    .logo-circle {
        width: 80px;
        height: 80px;
    }
    
    .vip-logo {
        width: 40px;
        height: 40px;
    }
}
</style>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>
