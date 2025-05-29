<?php
require_once('../model/adminModel.php');
session_start();

if (isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if ($email == "" || $password == "") {
        echo "null email/password!";
    } else {
        $user = ['email' => $email, 'password' => $password];
        $status = login($user);

        if ($status) {
            // Set session status on successful login
            $_SESSION['status'] = true;
            header('location: ../view/admin.php');
            exit();
        } else {
            header('location: ../view/adminlogin.html');
            exit();
        }
    }
} else {
    echo "Invalid request! Please submit form!";
}
?>
