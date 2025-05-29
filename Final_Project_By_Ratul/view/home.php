
<?php
  
  require_once('../model/adminModel.php');
  $cars = getAllCars();
session_start();
if (isset($_SESSION['status']) || isset($_COOKIE['status'])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Home </title>
  <link rel="stylesheet" href="../asset/home.css">
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
        <a href="../controller/logout.php" style="color: rgb(245, 54, 54);padding-right: 20px">Logout</a>
    </div>
  </div>


  <div class="home">
    <div class="home-content">
      <h1>Start a Reservation</h1>
     <form action="booking.php" method="get" onsubmit="return prepareBooking()">


        <select name="pickupLocation" id="pickupLocation" required>
          <option value="">Select Pickup Location</option>
          <option value="abdullahpur">Abdullahpur</option>
          <option value="bashundhara">Bashundhara</option>
          <option value="gulshan">Gulshan</option>
          <option value="motijheel">Motijheel</option>
      
      
      
        </select>
      <select name="carId" id="carId" onchange="updatePrice()" required>
      <option value="">Select a Car</option>
          <?php
     foreach ($cars as $car) {
     echo "<option value='" . $car['id'] . "'>" . $car['name'] . "</option>";
         }
        ?>
        </select>

       <input type="hidden" name="carPrice" id="carPrice">  


       

        <input type="date" name="startDate" id="startDate" required>
        <input type="date" name="endDate" id="endDate" required>
        <button type="submit">Book Now</button>
      </form>
    </div>
  </div>

  
  <section class="section">
    <h2 style="color: rgb(119, 35, 255);">Explore Our Fleet</h2>

    <div class="scrolling-text-container">
      <p class="scrolling-text">Choose from a wide variety of cars: Electric, SUV, Sedan, Pickup Truck to meet your travel needs!!!</p>
    </div>

    



  
  
<div class="gallery">
<?php
foreach ($cars as $car) {
  echo "<div class='car-card {$car['type']}' data-price='{$car['price']}'>";
  echo "<img src='{$car['image']}' alt='{$car['name']}'>";
  echo "<h3>{$car['name']}</h3>";
  echo "<p><strong>Price:</strong> \${$car['price']}/day</p>";
  echo "<p>{$car['details']}</p>";
  echo "</div>";
}
?>

</div>



 
  <div class="section" id= "demo">
    <h2>Join Our Loyalty Program</h2>
    <p>Earn points and enjoy free rental days, faster service, and exclusive offers.</p>
   
    <button onclick="load()" class="btn" >About Us</button>
  </div>


  <div class="footer">
    <p>&copy; 2025 CarRental Inc. All rights reserved.</p>
  </div>


  <script src="../asset/home.js"> </script>

  <script src="../asset/aboutusajex.js">
    
   </script>

</body>
</html>
<?php
    }else{
        header('location: login.html');
    }

?>


