<?php
session_start();
if (isset($_SESSION['status']) || isset($_COOKIE['status'])) {
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Maintenance Records </title>
  <link rel="stylesheet" href="../asset/home.css">
</head>
<body>

  <div class="navbar">
    <div class="logo">CarRental</div>
    <div class="nav-links">
        <a href="insurance.php">Insurances</a>
      <a href="damage-report.php">Damage Report</a>
      <a href="loyalty.php">Loyalty </a>
      <a href="customer-profile.php">My Account</a>
      <a href="home.php">Home</a>

       <a href="../controller/logout.php" style="color: rgb(245, 54, 54);padding-right: 20px">Logout</a>
    </div>
  </div>

  <div class="section">
    <h1>Maintenance Records</h1>
    

    <h2>Service Timeline</h2>
    <ul>
      <li>2025-05-01 Oil Change  20,000 km</li>
      <li>2025-03-15  Tire Rotation  17,000 km</li>
      <li>2024-12-01  Brake Inspection  13,000 km</li>
    </ul>

 
    <h2>Alert Dashboard</h2>
    <p><strong>Upcoming:</strong> Engine check due in 500 km</p>
    <p><strong>Overdue:</strong> Cabin filter replacement overdue by 1,200 km</p>


    <h2>Odometer Log</h2>
    <table border="1" cellpadding="10">
      <tr>
        <th>Date</th>
        <th>Odometer Reading</th>
      </tr>
      <tr>
        <td>2025-05-05</td>
        <td>21,000 km</td>
      </tr>
      <tr>
        <td>2025-04-01</td>
        <td>19,500 km</td>
      </tr>
      <tr>
        <td>2025-02-10</td>
        <td>16,000 km</td>
      </tr>
    </table>

  </div>

  <div class="footer">
    <p>&copy; 2025 CarRental Inc. All rights reserved.</p>
  </div>

</body>
</html>
<?php
    }else{
        header('location: login.html');
    }

?>
