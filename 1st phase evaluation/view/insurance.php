<?php
session_start();
if (isset($_SESSION['status']) || isset($_COOKIE['status'])) {
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Insurance Options</title>
  <link rel="stylesheet" href="../asset/home.css">
  <style>
    .insurance-container {
      max-width: 1000px;
      margin: auto;
      padding: 20px;
    }

    .tier-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 30px;
    }

    .tier-table th, .tier-table td {
      border: 1px solid #ddd;
      padding: 12px;
      text-align: center;
    }

    .tier-table th {
      background-color: #1877f2;
      color: white;
    }

    .claim-example {
      background-color: #f9f9f9;
      border: 1px solid #ccc;
      padding: 15px;
      margin-top: 20px;
    }
  </style>
</head>
<body>
     
  <div class="navbar">
    <div class="logo">CarRental</div>
    <div class="nav-links">
        <a href="damage-report.php">Damage Report</a> 
      <a href="maintenance.php">Maintenance</a>
      <a href="loyalty.php">Loyalty </a>
     
      <a href="customer-profile.php">My Account</a>
      <a href="home.php">Home</a>
   <a href="../controller/logout.php" style="color: rgb(245, 54, 54);padding-right: 20px">Logout</a>
    </div>
  </div>

  <div class="insurance-container">
    <h1>Insurance Options</h1>
    <p>Compare coverage tiers and understand your protection.</p>


    <table class="tier-table">
      <tr>
        <th>Tier</th>
        <th>Coverage</th>
        <th>Deductible</th>
      </tr>
      <tr>
        <td>Basic</td>
        <td>Liability Only</td>
        <td>$1,000</td>
      </tr>
      <tr>
        <td>Standard</td>
        <td>Liability + Collision</td>
        <td>$500</td>
      </tr>
      <tr>
        <td>Premium</td>
        <td>Full Coverage</td>
        <td>$0</td>
      </tr>
    </table>

   
    <h2>Terms & Conditions</h2>
    <p>Please read the insurance policy details carefully before selecting your plan.</p>

  
    <h2>Claim Simulator</h2>
    <div class="claim-example">
      <p><strong>Example:</strong> You damage a rental vehicle worth $10,000.</p>
      <ul>
        <li><strong>Basic:</strong> You pay $1,000</li>
        <li><strong>Standard:</strong> You pay $500</li>
        <li><strong>Premium:</strong> You pay $0</li>
      </ul>
    </div>
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