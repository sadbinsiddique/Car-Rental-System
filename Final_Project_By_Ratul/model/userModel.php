<?php
require_once('connection.php');

function login($user){
    $con = getConnection();
    $sql = "SELECT * FROM users WHERE email='{$user['email']}' AND password='{$user['password']}'";
    $result = mysqli_query($con, $sql);
    if(mysqli_num_rows($result) == 1){
        return true;
    } else {
        return false;
    }
}

function addUser($user){
    $con = getConnection();
    $sql = "INSERT INTO users (firstname, lastname, email, password, dob, license) 
            VALUES ('{$user['firstname']}', '{$user['lastname']}', '{$user['email']}',
         '{$user['password']}', '{$user['dob']}', '{$user['license']}')";
    
    if(mysqli_query($con, $sql)){
        return true;
    } else {
        return false;
    }
}
function emailExists($email) {
    $conn = getConnection();
    $sql = "SELECT * FROM users WHERE email = '{$email}'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}




?>
