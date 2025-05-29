<?php
// Debug script to test routing and authentication
session_start();

echo "<h2>Debug Information</h2>";
echo "<strong>Request URI:</strong> " . $_SERVER['REQUEST_URI'] . "<br>";
echo "<strong>GET url:</strong> " . ($_GET['url'] ?? 'not set') . "<br>";
echo "<strong>Session user_id:</strong> " . ($_SESSION['user_id'] ?? 'not set') . "<br>";
echo "<strong>Session user_type:</strong> " . ($_SESSION['user_type'] ?? 'not set') . "<br>";

echo "<h3>Testing App Routing</h3>";

// Include the App class
require_once '../app/core/Database.php';
require_once '../app/core/Model.php';
require_once '../app/core/Controller.php';
require_once '../app/core/App.php';

try {
    $app = new app\core\App();
    echo "✓ App class instantiated successfully<br>";
    
    // Test routing to login
    $_GET['url'] = 'auth/login';
    echo "<strong>Testing route:</strong> auth/login<br>";
    
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "<br>";
}

echo "<h3>Test Login Form</h3>";
echo '<form method="post" action="/auth/login" style="max-width: 400px; margin: 20px 0;">
    <div style="margin-bottom: 10px;">
        <label>Email:</label><br>
        <input type="email" name="email" value="test@example.com" style="width: 100%; padding: 8px;">
    </div>
    <div style="margin-bottom: 10px;">
        <label>Password:</label><br>
        <input type="password" name="password" value="password123" style="width: 100%; padding: 8px;">
    </div>
    <div style="margin-bottom: 10px;">
        <input type="checkbox" name="remember" value="1" id="remember">
        <label for="remember">Remember me</label>
    </div>
    <button type="submit" style="background: #007bff; color: white; padding: 10px 20px; border: none; cursor: pointer;">
        Login
    </button>
</form>';

echo "<h3>Logout</h3>";
echo '<a href="/auth/logout" style="color: red;">Logout</a>';
?>
