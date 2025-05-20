<?php
session_start();
if (isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if ($email == "" || $password == "") {
        echo "null email/password!";
    } else if ($email == $password) {
        if (isset($_POST['remember'])) {
           
            setcookie('status', 'true', time() + 5, '/');
        } else {
            $_SESSION['status'] = true;
        }
        header('location:../view/admin.php');
    } else {
        echo "invalid user!";
    }
} else {
    echo "Invalid request! Please submit form!";
}
?>
