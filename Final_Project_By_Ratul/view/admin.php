<?php
session_start();
require_once('../model/adminModel.php');

if (!isset($_SESSION['status'])) {
    header('location: adminLogin.html');
    exit;
}

$users = getAllUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>User Management</title>
  <link rel="stylesheet" href="../asset/admin.css" />
</head>
<body>


  <div class="navbar">
    <div class="logo">User Management</div>
    <div class="menu-bar">
       <a href="cars.php">Car Management</a>
      <a href="../controller/adminLogout.php" style="color: rgb(137, 27, 27)">Logout</a>
    </div>
  </div>


  <div class="section">
    <h2>All Users</h2>


    <table>
      <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Password</th>
        <th>DOB</th>
        <th>License</th>
        <th>Actions</th>
      </tr>

      <?php foreach($users as $user): ?>
        <tr>
         <?php
               echo "
            <td>{$user['id']}</td>
             <td>{$user['firstname']}</td>
             <td>{$user['lastname']}</td>
              <td>{$user['email']}</td>
              <td>{$user['password']}</td>
             <td>{$user['dob']}</td>
            <td>{$user['license']}</td>
           <td>
                      ";
                 ?>

            <a href="editUser.php?id=<?= $user['id'] ?>">Edit</a> |
            <a href="../controller/userController.php?delete=<?= $user['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>

 
    <h3 style="margin-top: 40px;">Add New User</h3>

    <form action="../controller/userController.php" method="POST" style="max-width: 500px; margin: auto; text-align: left;">

      <input type="text" name="firstname" placeholder="First Name" required /><br />
      <input type="text" name="lastname" placeholder="Last Name" required /><br />
      <input type="email" name="email" placeholder="Email" required /><br />
      <input type="password" name="password" placeholder="Password" required /><br />
      <input type="date" name="dob" required /><br />
      <input type="text" name="license" placeholder="License No." required /><br />
      <button type="submit" name="add" class="btn">Add User</button>
    </form>
  </div>

 
  <div class="footer">
    <p>&copy; <?= date("Y") ?> CarRental Admin</p>
  </div>

</body>
</html>
