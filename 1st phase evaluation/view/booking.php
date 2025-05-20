<?php
session_start();
if (isset($_SESSION['status']) || isset($_COOKIE['status'])) {
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Booking Summary </title>
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
      
      <a href="fleet.html">Vehicles</a>
      <a href="profile.html">Loyalty</a>
      <a href="home.html">Home</a>
    <a href="../controller/logout.php" style="color: rgb(245, 54, 54);padding-right: 20px">Logout</a>
    </div>
  </div>

  <div class="booking-summary">
    <h2>Your Booking Summary</h2>
    <p><strong>Pickup Location:</strong> <span id="location"></span></p>
    <p><strong>Car Type:</strong> <span id="carType"></span></p>
    <p><strong>Start Date:</strong> <span id="startDate"></span></p>
    <p><strong>End Date:</strong> <span id="endDate"></span></p>
    <p><strong>Daily Rate:</strong> $<span id="dailyRate"></span></p>
    <p class="total">Total Price: $<span id="totalPrice"></span></p>
  </div>

  <script>
    function getQueryParam(key) {
      const urlParams = new URLSearchParams(window.location.search);
      return urlParams.get(key);
    }

    function calculateDays(start, end) {
      const startDate = new Date(start);
      const endDate = new Date(end);
      const diffTime = endDate - startDate;
      const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
      return diffDays;
    }

    window.onload = function () {
      const location = getQueryParam("pickupLocation");
      const carType = getQueryParam("carType");
      const startDate = getQueryParam("startDate");
      const endDate = getQueryParam("endDate");
      const price = parseFloat(getQueryParam("carPrice"));

      const days = calculateDays(startDate, endDate);
      const totalPrice = days * price;

      document.getElementById("location").textContent = capitalize(location);
      document.getElementById("carType").textContent = carType.toUpperCase();
      document.getElementById("startDate").textContent = startDate;
      document.getElementById("endDate").textContent = endDate;
      document.getElementById("dailyRate").textContent = price.toFixed(2);
      document.getElementById("totalPrice").textContent = totalPrice.toFixed(2);
    };

    function capitalize(str) {
      return str.charAt(0).toUpperCase() + str.slice(1);
    }
  </script>

</body>
</html>


<?php
    }else{
        header('location: login.html');
    }

?>
