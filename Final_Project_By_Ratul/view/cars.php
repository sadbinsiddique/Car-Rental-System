<?php
session_start();
require_once('../model/adminModel.php');

if (!isset($_SESSION['status'])) {
    header('location: adminLogin.html');
    exit;
}

$cars = getAllCars();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Manage Cars</title>
  <link rel="stylesheet" href="../asset/admin.css" />
</head>
<body>

<div class="navbar">
  <div class="logo">Car Management</div>
  <div class="menu-bar">
    <a href="admin.php">User Panel</a>
    <a href="../controller/adminLogout.php" style="color: red">Logout</a>
  </div>
</div>

<div class="section">
  <h2>All Cars</h2>

  <table>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Category</th>
      <th>Price</th>
      <th>Details</th>
      <th>Image</th>
      <th>Actions</th>
    </tr>

    <?php foreach($cars as $car): ?>
    <tr>
      <?php
        echo "
        <td>{$car['id']}</td>
        <td>{$car['name']}</td>
        <td>{$car['category']}</td>
        <td>{$car['price']}</td>
        <td>{$car['details']}</td>
        <td><img src='{$car['image']}' width='100'></td>
        <td>";
      ?>
      
      <a href="editCar.php?id=<?= $car['id'] ?>">Edit</a> |
      <a href="../controller/carController.php?deleteCar=<?= $car['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>

  <h3 style="margin-top: 40px;">Add New Car</h3>
  <form action="../controller/carController.php" method="POST" style="max-width: 500px; margin: auto; text-align: left;">
    <input type="text" name="name" placeholder="Car Name" required /><br />
    <input type="text" name="category" placeholder="Category" required /><br />
    <input type="number" name="price" placeholder="Price" required /><br />
    <input type="text" name="details" placeholder="Details" required /><br />
    <input type="text" name="image" placeholder="Image URL" required /><br />
    <button type="submit" name="addCar" class="btn">Add Car</button>
  </form>
</div>

<div class="footer">
  <p>&copy; <?= date("Y") ?> CarRental Admin</p>
</div>

</body>
</html>
