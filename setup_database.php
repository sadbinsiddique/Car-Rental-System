<?php
// Include database connection
require_once 'model/db.php';

// Function to execute SQL from a file
function executeSQLFile($conn, $file) {
    echo "<h3>Executing SQL commands from: $file</h3>";
    
    $sql = file_get_contents($file);
    
    // Split SQL by semicolon to execute multiple statements
    $statements = array_filter(array_map('trim', explode(';', $sql)));
    
    $success = true;
    foreach ($statements as $statement) {
        if (!empty($statement)) {
            if (mysqli_query($conn, $statement)) {
                echo "<p style='color:green'>✓ SUCCESS: " . substr($statement, 0, 50) . "...</p>";
            } else {
                echo "<p style='color:red'>✗ ERROR: " . mysqli_error($conn) . " in statement: " . substr($statement, 0, 100) . "...</p>";
                $success = false;
            }
        }
    }
    return $success;
}

// Get database connection
$conn = getConnection();

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "<html>
<head>
    <title>Car Rental System - Database Setup</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; line-height: 1.6; }
        h1, h2, h3 { color: #333; }
        .container { max-width: 800px; margin: 0 auto; background: #f5f5f5; padding: 20px; border-radius: 5px; }
        .success { color: green; font-weight: bold; }
        .error { color: red; font-weight: bold; }
        pre { background: #eee; padding: 10px; border-radius: 5px; }
    </style>
</head>
<body>
    <div class='container'>
        <h1>Car Rental System Database Setup</h1>";

// Create tables from schema file
$schema_file = 'database/create_tables.sql';
if (file_exists($schema_file)) {
    $tables_created = executeSQLFile($conn, $schema_file);
    
    // If tables were created successfully, insert sample data
    if ($tables_created) {
        $data_file = 'database/insert_sample_data.sql';
        if (file_exists($data_file)) {
            executeSQLFile($conn, $data_file);
        } else {
            echo "<p class='error'>Sample data file not found: $data_file</p>";
        }
    }
} else {
    echo "<p class='error'>Schema file not found: $schema_file</p>";
}

echo "<h2>Database setup complete!</h2>
      <p>You can now <a href='index.php'>return to the homepage</a>.</p>
      <p>Log in with:</p>
      <ul>
        <li>Admin: username: 'admin', password: 'admin123'</li>
        <li>Customer: username: 'sadbin', password: 'pass123'</li>
      </ul>
    </div>
</body>
</html>";

// Close connection
mysqli_close($conn);
?>
