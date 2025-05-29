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
  <link rel="stylesheet" href="../asset/damage.css">
  
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

  
    <h2>Vehicle Diagram Mark Damage</h2>
    <div class="canvas-area" id="damageCanvas">

    </div>

 
    <h2>Add Photos & Notes</h2>
     <div>
      <form method="post" action="../controller/upload_Check.php" enctype="multipart/form-data">
            File: <input type="file" name="myfile" />
            <input type="submit" name="submit" value="Submit" />
    </div>

 
    <h2>Customer Signature</h2>
    <p>Please sign below to confirm the reported condition:</p>
    <div class="signature-box" id="signaturePad">

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
