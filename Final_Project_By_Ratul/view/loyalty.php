<?php
session_start();
if (isset($_SESSION['status']) || isset($_COOKIE['status'])) {
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Loyalty Program </title>
  <link rel="stylesheet" href="../asset/home.css">
</head>
<body>

  <div class="navbar">
    <div class="logo">CarRental</div>
    <div class="nav-links">
        <a href="insurance.php">Insurances</a>
      <a href="damage-report.php">Damage Report</a>
      <a href="maintenance.php">Maintenance </a>
      
      <a href="customer-profile.php">My Account</a>
      <a href="home.php">Home</a>

      <a href="../controller/logout.php" style="color: rgb(245, 54, 54);padding-right: 20px">Logout</a>
    </div>
  </div>

  <div class="section">
    <h1>Loyalty Program</h1>
    <p>Earn points for every dollar you spend and unlock exciting rewards!</p>

    <h2>Points Tracker</h2>
    <ul>
      <li>Current Points: <strong>1,250</strong></li>
      <li>Points to next tier: <strong>250</strong></li>
    </ul>

    <h2>Reward Catalog</h2>
    <ul>
      <p>Free Upgrade  500 points</p>
      <p>1 Free Rental Day  1,000 points</p>
      <li>VIP Parking 750 points</li>
    </ul>

    <h2>Tier Benefits</h2>
    <ul>
      <li><strong>Silver:</strong> Basic benefits</li>
      <li><strong>Gold:</strong> Faster service, early access</li>
      <li><strong>Platinum:</strong> Free upgrades, premium support</li>
    </ul>
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
