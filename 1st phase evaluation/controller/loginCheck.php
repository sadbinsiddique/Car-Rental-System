<?php
session_start();
if (isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if ($email == "" || $password == "") {
        echo "null email/password!";
    } else if ($email == $password) {
        if (isset($_POST['remember'])) {
            $_SESSION['status'] = true;
            
        } else {
           
            setcookie('status', 'true', time() + 3, '/');
        }
       header('location:../view/home.php');
    } else {
        echo "invalid user!";
    }
} else {
    echo "Invalid request! Please submit form!";
}
?>
