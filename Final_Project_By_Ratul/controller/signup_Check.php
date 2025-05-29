<?php

//lall kal
require_once('../model/userModel.php');
if (isset($_POST['submit'])) {
   
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $dob = trim($_POST['dob']);
    $license = trim($_POST['license']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    
    if (
        $firstname == "" || $lastname == "" || $dob == "" || $license == "" ||
        $email == "" || $password == "" || $confirm == ""
    ) {
        echo "Please fill out all fields!";
    }
  
    else if (strlen($license) < 6 || strlen($license) > 15) {
        echo "License Number must be between 6 and 15 characters!";
    }

    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address!";
    }

    else if (strlen($password) < 6) {
        echo "Password must be at least 6 characters!";
    }

    else if ($password !== $confirm) {
        echo "Passwords do not match!";
    }
    else {
        $user = ['firstname'=> $firstname, 'lastname'=> $lastname, 'dob'=> $dob,'license'=> $license,
         'email'=>$email, 'password'=>$password];
        $status = addUser($user);
         
        if($status){
                header('location: ../view/login.html');
            }else{
                header('location: ../view/signup.html');
            }

      
    }
}
 else {
    echo "Invalid request! Please submit form!";
}
?>
