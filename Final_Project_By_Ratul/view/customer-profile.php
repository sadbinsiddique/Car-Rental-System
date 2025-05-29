<?php
session_start();
if (isset($_SESSION['status']) || isset($_COOKIE['status'])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Customer Profile </title>
  <link rel="stylesheet" href="../asset/home.css">
  <link rel="stylesheet" href="customer-profile.css"> 
</head>
<body>


  <div class="navbar">
    <div class="logo">CarRental</div>
    <div class="nav-links">
        <a href="insurance.php">Insurances</a>
        <a href="maintenance.php">Maintenance</a>
      <a href="damage-report.php">Damage Report</a>
      <a href="loyalty.php">Loyalty</a>
      <a href="customer-profile.php">My Account</a>
      <a href="home.php">Home</a>
         <a href="../controller/logout.php" style="color: rgb(245, 54, 54);padding-right: 20px">Logout</a>
    </div>
  </div>

  <div class="profile-section">

  
    <h2>Driving License Scanner</h2>

    <p>Scan your license to auto-fill profile details:</p>
    <button class="scan-button">📷 Scan License</button>
    <div class="form-group">
      <label for="full-name">Full Name</label>
      <input type="text" id="full-name" value="John Doe" placeholder="Auto-filled name" disabled>
    </div>
    <div>
      <form method="post" action="../controller/upload_Check.php" enctype="multipart/form-data">
            File: <input type="file" name="myfile" />
            <input type="submit" name="submit" value="Submit" />
    </div>
    <div class="form-group">
      <label for="license-number">License Number</label>
      <input type="text" id="license-number" value="AB1234567" placeholder="Auto-filled number" disabled>
    </div>
  </div>

  <div class="profile-section">
    <h2>Preference Center</h2>
    <form>
      <div class="form-group">
        <label for="seat-position">Seat Position</label>
        <select id="seat-position">
          <option>Upright</option>
          <option>Relaxed</option>
          <option>Custom</option>
        </select>
      </div>
      <div class="form-group">
        <label for="mirror-angle">Mirror Angle</label>
        <select id="mirror-angle">
          <option>Standard</option>
          <option>Wide</option>
          <option>Custom</option>
        </select>
      </div>
      <button class="scan-button" type="submit">Save Preferences</button>
    </form>
  </div>

  <div class="profile-section">
    <h2>Rental History</h2>
    <div class="rental-item">
      <strong>Mar 15-Mar 18, 2025</strong><br>
      Toyota Corolla - $180<br>
      <a href="#">View Receipt</a>
    </div>
    <div class="rental-item">
      <strong>Feb 02 Feb 04, 2025</strong><br>
      Tesla Model 3  $220<br>
      <a href="#">View Receipt</a>
    </div>

  </div>

  <div class="footer">
    <p>&copy; 2025 CarRental Inc. All rights reserved.</p>
  </div>

</body>
</html>
<?php
} else {
    header('location: login.html');
}
?>