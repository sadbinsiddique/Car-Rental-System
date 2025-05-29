<?php
session_start();
require_once('../model/adminModel.php');

if (!isset($_SESSION['status'])) {
    header('location: adminLogin.html');
    exit;
}

if (!isset($_GET['id'])) {
    echo "Invalid request.";
    exit;
}

$id = $_GET['id'];
$car = getCarById($id);

if (!$car) {
    echo "Car not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Car</title>
  <link rel="stylesheet" href="../asset/admin.css">
</head>
<body>

<div class="navbar">
  <div class="logo">Edit Car</div>
  <div class="menu-bar">
    <a href="cars.php">Car Panel</a>
    <a href="../controller/adminLogout.php" style="color: red">Logout</a>
  </div>
</div>

<div class="section">
  <h2>Edit Car</h2>

  <form action="../controller/carController.php" method="POST">
    <input type="hidden" name="id" value="<?= $car['id'] ?>">

    <label>Name:</label>
    <input type="text" name="name" value="<?= $car['name'] ?>" required><br><br>

    <label>Category:</label>
    <input type="text" name="category" value="<?= $car['category'] ?>" required><br><br>

    <label>Price:</label>
    <input type="number" name="price" value="<?= $car['price'] ?>" required><br><br>

    <label>Details:</label>
    <input type="text" name="details" value="<?= $car['details'] ?>" required><br><br>

    <label>Image URL:</label>
    <input type="text" name="image" value="<?= $car['image'] ?>" required><br><br>

    <button type="submit" name="updateCar">Update</button>
  </form>

  <br>
  <a href="cars.php">← Back to Car Panel</a>
</div>

<div class="footer">
  &copy; <?= date("Y") ?> CarRental Admin
</div>

</body>
</html>
