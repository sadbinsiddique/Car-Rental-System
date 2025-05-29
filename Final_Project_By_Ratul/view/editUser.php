
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
$user = getUserById($id);

if (!$user) {
    echo "User not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit User</title>
  <link rel="stylesheet" href="../asset/admin.css">
</head>
<body>

  <div class="navbar">
    <div class="logo">Admin Panel</div>
    <div class="nav-links">
      <a href="admin.php">Dashboard</a>
     <a href="../controller/adminLogout.php" style="color: rgb(137, 27, 27)">Logout</a>
    </div>
  </div>

  <div class="section">
    <h2>Edit User</h2>

    <form action="../controller/userController.php" method="POST">
      <input type="hidden" name="id" value="<?= $user['id'] ?>">

      <label>First Name:</label>
      <input type="text" name="firstname" value="<?= $user['firstname'] ?>" required><br><br>

      <label>Last Name:</label>
      <input type="text" name="lastname" value="<?= $user['lastname'] ?>" required><br><br>

      <label>Email:</label>
      <input type="email" name="email" value="<?= $user['email'] ?>" required><br><br>


      <label>Password:</label>
      <input type="password" name="password" value="<?= $user['password'] ?>" required><br><br>


      <label>Date of Birth:</label>
      <input type="date" name="dob" value="<?= $user['dob'] ?>" required><br><br>


      <label>License:</label>
      <input type="text" name="license" value="<?= $user['license'] ?>" required><br><br><br>


      <button type="submit" name="update">Update</button><br>
    </form>

    <br>
    <a href="admin.php">← Back to Admin Panel</a><br><br><br><br><br><br><br><br><br>
  </div>

<div class="footer">
    © 2025 Admin Panel. All rights reserved.
</div>


</body>
</html>
