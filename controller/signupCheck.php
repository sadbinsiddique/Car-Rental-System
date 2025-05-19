<?php
    session_start();
    require_once('../model/userModel.php');

    if(isset($_POST['submit'])){
        // Retrieve form data
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $email = $_POST['email'] ?? '';
        $full_name = $_POST['full_name'] ?? $username; // Use username if full name not provided

        // Basic validation
        if(empty($username) || empty($password) || empty($email)){
            header('location: ../view/signup.html?error=empty_fields');
            exit();
        }

        // Username validation (alphanumeric and underscore only)
        if(!preg_match('/^[a-zA-Z0-9_]+$/', $username)){
            header('location: ../view/signup.html?error=invalid_username');
            exit();
        }

        // Password validation (minimum 6 characters)
        if(strlen($password) < 6){
            header('location: ../view/signup.html?error=password_too_short');
            exit();
        }

        // Email validation
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            header('location: ../view/signup.html?error=invalid_email');
            exit();
        }

        // Create user array with all required fields
        $user = [
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'full_name' => $full_name,
            'phone' => $_POST['phone'] ?? '',
            'address' => $_POST['address'] ?? ''
        ];

        // Add user to database
        $status = addUser($user);

        if($status){
            // Redirect to login page with success message instead of home page
            header('location: ../view/login.html?registration=success');
        }else{
            header('location: ../view/signup.html?error=registration_failed');
        }
    } else {
        header('location: ../view/signup.html');
    }
?>