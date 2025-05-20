<?php
session_start();
if (isset($_SESSION['status']) || isset($_COOKIE['status'])) {
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Damage Reports</title>
  <link rel="stylesheet" href="../asset/home.css">
  <style>
    .canvas-area {
      border: 1px solid #ccc;
      margin: 20px auto;
      width: 500px;
      height: 300px;
      background-image: url('vehicle-diagram.png'); 
      background-size: cover;
      position: relative;
    }

    .photo-upload input {
      margin: 10px 0;
    }

    .signature-box {
      border: 1px dashed #999;
      width: 100%;
      height: 150px;
      margin-top: 10px;
    }
  </style>
</head>
<body>

  <div class="navbar">
    <div class="logo">CarRental</div>
    <div class="nav-links">
        <a href="insurance.php">Insurances</a>
      <a href="maintenance.php">Maintenance</a>
      <a href="loyalty.php">Loyalty</a>
      <a href="customer-profile.php">My Account</a>
      <a href="home.php">Home</a>
        <a href="../controller/logout.php" style="color: rgb(245, 54, 54);padding-right: 20px">Logout</a>
    </div>
  </div>

  <div class="section">
    <h1>Damage Report</h1>

    <!-- Vehicle Inspection Tool -->
    <h2>Vehicle Diagram Mark Damage</h2>
    <div class="canvas-area" id="damageCanvas">
      <!-- JS-based marker tool would go here -->
    </div>

    <!-- Annotation/Photos -->
    <h2>Add Photos & Notes</h2>
    <div class="photo-upload">
      <input type="file" accept="image/*" multiple>
      <textarea placeholder="Describe the damage..." rows="4" style="width:100%;"></textarea>
    </div>

    <!-- Digital Signature -->
    <h2>Customer Signature</h2>
    <p>Please sign below to confirm the reported condition:</p>
    <div class="signature-box" id="signaturePad">
      <!-- Add JS signature pad support -->
    </div>
    <button style="margin-top:10px;">Submit Report</button>
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
