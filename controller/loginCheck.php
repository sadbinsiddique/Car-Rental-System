<?php
    session_start();
    require_once('../model/userModel.php');

    if(isset($_POST['submit'])){
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        if(empty($username) || empty($password)){
            header('location: ../view/login.html?error=empty');
            exit();
        }

        $status = login($username, $password);
        
        if($status){
            setcookie('status', 'true', time()+3600, '/');
            $_SESSION['username'] = $username;
            header('location: ../view/home.php');
        }else{
            header('location: ../view/login.html?error=invalid');
        }
    }else{
        header('location: ../view/login.html');
    }
?>