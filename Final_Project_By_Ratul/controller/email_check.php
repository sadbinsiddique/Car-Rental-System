<?php
require_once('../model/userModel.php');
session_start();

if (isset($_POST['email'])) {
    $email = trim($_POST['email']);

    if ($email == "") {
        echo "<span style='color:red;'>Email cannot be empty</span>";
    } else {
        if (emailExists($email)) {
            echo "<span style='color:red;'>Email already exists</span>";
        } else {
            echo "<span style='color:green;'>Email is available</span>";
        }
    }
} else {
    echo "Invalid request!";
}
?>
