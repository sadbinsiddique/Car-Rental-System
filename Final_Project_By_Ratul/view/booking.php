<?php
require_once('../model/adminModel.php');

session_start();
if (isset($_SESSION['status']) || isset($_COOKIE['status'])) {
    if (isset($_GET['carId']) && isset($_GET['pickupLocation']) && isset($_GET['startDate']) && isset($_GET['endDate'])) {
        $carId = $_GET['carId'];
        $pickupLocation = $_GET['pickupLocation'];
        $startDate = $_GET['startDate'];
        $endDate = $_GET['endDate'];

        $car = getCarById($carId); 
        $dailyRate = $car['price'];

        $days = (strtotime($endDate) - strtotime($startDate)) / (60 * 60 * 24);
        if ($days <= 0) {
            $days = 1; 
        }
        $totalPrice = $days * $dailyRate;
    } else {
        echo "Missing booking information.";
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Booking Summary</title>
  <link rel="stylesheet" href="../asset/home.css">
  <style>
    .booking-summary {
      max-width: 600px;
      margin: 50px auto;
      padding: 20px;
      border: 2px solid #ccc;
      border-radius: 10px;
      background-color: #f8f8f8;
    }
    .booking-summary h2 {
      text-align: center;
      color: #333;
    }
    .booking-summary p {
      font-size: 18px;
      margin: 10px 0;
    }
    .total {
      font-weight: bold;
      color: green;
    }
  </style>
</head>
<body>

  <div class="navbar">
    <div class="logo">CarRental</div>
    <div class="nav-links">
      
   
      <a href="home.php">Home</a>
      <a href="../controller/logout.php" style="color: rgb(245, 54, 54); padding-right: 20px;">Logout</a>
    </div>
  </div>

  <div class="booking-summary">
    <h2>Your Booking Summary</h2>
    <p><strong>Pickup Location:</strong> <?= htmlspecialchars(ucfirst($pickupLocation)) ?></p>
    <p><strong>Car:</strong> <?= htmlspecialchars($car['name']) ?></p>
    <p><strong>Start Date:</strong> <?= htmlspecialchars($startDate) ?></p>
    <p><strong>End Date:</strong> <?= htmlspecialchars($endDate) ?></p>
    <p><strong>Daily Rate:</strong> $<?= number_format($dailyRate, 2) ?></p>
    <p><strong>Total Days:</strong> <?= $days ?></p>
    <p class="total">Total Price: $<?= number_format($totalPrice, 2) ?></p>
  </div>

</body>
</html>

<?php
} else {
    header('location: login.html');
}
?>
