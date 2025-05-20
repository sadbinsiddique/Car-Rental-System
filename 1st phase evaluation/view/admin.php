

<?php
session_start();
if (isset($_SESSION['status']) || isset($_COOKIE['status'])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel </title>
  <link rel="stylesheet" href="../asset/admin.css">
</head>
<body>

  <div class="navbar">
    <div class="logo">Admin Panel</div>
    <div class="nav-links">
      <a href="home.html">Home</a>
      <a href="#users">Users</a>
      <a href="#content">Content</a>
      <a href="#settings">Settings</a>
         <a href="../controller/adminLogout.php" style="color: rgb(245, 54, 54);padding-right: 20px">Logout</a>
    </div>
  </div>

  <div class="section" id="users">
    <h2>User Management</h2>
    <input type="search" placeholder="Search users...">
    <table>
      <tr><th>Name</th><th>Email</th><th>Role</th><th><input type="checkbox"></th></tr>
      <tr><td>Alice</td><td>alice@example.com</td><td>Admin</td><td><input type="checkbox"></td></tr>
      <tr><td>Bob</td><td>bob@example.com</td><td>User</td><td><input type="checkbox"></td></tr>
    </table>
    <button>Delete Selected</button>
  </div>

  <div class="section" id="content">
    <h2>Content Moderation</h2>
    <select>
      <option>All</option>
      <option>Pending</option>
      <option>Flagged</option>
    </select>
    <ul>
      <li>Review: “Car was great!” <button>Remove</button></li><br>
      <li>Comment: “Bad service!!” <button>Flag</button></li>
    </ul>
  </div>

  <div class="section" id="settings">
    <h2>System Settings</h2>
    <label>
      Maintenance Mode:
      <input type="checkbox">
    </label>
    <br>
    <label>
      Max Reservations per User:
      <input type="number" value="5">
    </label>
    <br>
    <button style=" background-color: #07c624;">Save Settings</button>
  </div>

  <div class="footer">
    <p>&copy; 2025 CarRental Admin</p>
  </div>

</body>
</html>

<?php
    }else{
        header('location:adminLogin.html');
    }

?>
