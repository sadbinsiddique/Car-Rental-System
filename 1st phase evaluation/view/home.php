
<?php
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

        <select name="carType" id="carType" required onchange="CarPrice()">
          <option value="">Select Car Type</option>
          <option value="suv">SUV</option>
          <option value="sedan">Sedan</option>
          <option value="electric">Electric</option>
          <option value="pickup">Pickup Truck</option>
        </select>

        <input type="hidden" name="carPrice" id="carPrice">

        <input type="date" name="startDate" id="startDate" required>
        <input type="date" name="endDate" id="endDate" required>
        <button type="submit">Search</button>
      </form>
    </div>
  </div>

  
  <section class="section">
    <h2 style="color: rgb(119, 35, 255);">Explore Our Fleet</h2>

    <div class="scrolling-text-container">
      <p class="scrolling-text">Choose from a wide variety of cars: Electric, SUV, Sedan, Pickup Truck to meet your travel needs!!!</p>
    </div>

    <div class="category-filter">
      <button onclick="filterCars('all')">All</button>
      <button onclick="filterCars('electric')">Electric</button>
      <button onclick="filterCars('suv')">SUV</button>
      <button onclick="filterCars('sedan')">Sedan</button>
      <button onclick="filterCars('pickup')">Pickup Truck</button>
    </div>

 
<section class="section">

  
    <div class="gallery">

      <div class="car-card electric" data-price="80"><img src="../asset/photos/Electric1.jpg"><h3>Electric Car 1</h3></div>
      <div class="car-card electric" data-price="85"><img src="../asset/photos/Electric2.jpg"><h3>Electric Car 2</h3></div>
      <div class="car-card electric" data-price="90"><img src="../asset/photos/Electric3.jpg"><h3>Electric Car 3</h3></div>
      <div class="car-card electric" data-price="95"><img src="../asset/photos/Electric4.jpg"><h3>Electric Car 4</h3></div>
  
     
      <div class="car-card suv" data-price="60"><img src="../asset/photos/SUV1.jpg"><h3>SUV 1</h3></div>
      <div class="car-card suv" data-price="65"><img src="../asset/photos/SUV2.jpg"><h3>SUV 2</h3></div>
      <div class="car-card suv" data-price="70"><img src="../asset/photos/SUV3.jpg"><h3>SUV 3</h3></div>
      <div class="car-card suv" data-price="75"><img src="../asset/photos/SUV4.jpg"><h3>SUV 4</h3></div>
  
     
      <div class="car-card sedan" data-price="70"><img src="../asset/photos/Sedan1.jpg"><h3>Sedan 1</h3></div>
      <div class="car-card sedan" data-price="72"><img src="../asset/photos/Sedan2.jpg"><h3>Sedan 2</h3></div>
      <div class="car-card sedan" data-price="74"><img src="../asset/photos/Sedan3.jpg"><h3>Sedan 3</h3></div>
      <div class="car-card sedan" data-price="76"><img src="../asset/photos/Sedan4.jpg"><h3>Sedan 4</h3></div>
  
    
      <div class="car-card pickup" data-price="80"><img src="../asset/photos/Pickup_Truck1.jpg"><h3>Pickup 1</h3></div>
      <div class="car-card pickup" data-price="85"><img src="../asset/photos/Pickup_Truck2.jpg"><h3>Pickup 2</h3></div>
      <div class="car-card pickup" data-price="90"><img src="../asset/photos/Pickup_Truck3.jpg"><h3>Pickup 3</h3></div>
      <div class="car-card pickup" data-price="95"><img src="../asset/photos/Pickup_Truck4.jpg"><h3>Pickup 4</h3></div>
    </div>
  </section>
  
  </section>

 
  <div class="section">
    <h2>Join Our Loyalty Program</h2>
    <p>Earn points and enjoy free rental days, faster service, and exclusive offers.</p>
    <a href="loyalty.html" class="btn">Learn More</a>
  </div>


  <div class="footer">
    <p>&copy; 2025 CarRental Inc. All rights reserved.</p>
  </div>


  <script src="../asset/home.js">
   
  </script>

</body>
</html>
<?php
    }else{
        header('location: login.html');
    }

?>