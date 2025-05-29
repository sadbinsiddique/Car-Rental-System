<?php
require_once('connection.php');

function login($user){
    $con = getConnection();
    $sql = "SELECT * FROM adminlogin WHERE email='{$user['email']}' AND password='{$user['password']}'";
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

function getAllUsers() {
    $con = getConnection();
    $sql = "SELECT * FROM users";
    $result = mysqli_query($con, $sql);
    $users = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }

    return $users;
}

function getUserById($id) {
    $con = getConnection();
    $sql = "SELECT * FROM users WHERE id = {$id}";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_assoc($result);
}

function updateUser($user) {
    $con = getConnection();
    $sql = "UPDATE users SET firstname='{$user['firstname']}', lastname='{$user['lastname']}',
     email='{$user['email']}', password='{$user['password']}', dob='{$user['dob']}',
      license='{$user['license']}' WHERE id={$user['id']}";
    return mysqli_query($con, $sql);
}

function deleteUser($id) {
    $con = getConnection();
    $sql = "DELETE FROM users WHERE id = {$id}";
    return mysqli_query($con, $sql);
}



function getAllCars() {
    $con = getConnection();
    $sql = "SELECT * FROM cars";
    $result = mysqli_query($con, $sql);

    $cars = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $cars[] = $row;
    }
    return $cars;
}

function getCarById($id) {
    $con = getConnection();
    $sql = "SELECT * FROM cars WHERE id = $id";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_assoc($result);
}








function addCar($car) {
    $con = getConnection();
    $sql = "INSERT INTO cars (name, category, price, details, image) 
            VALUES ('{$car['name']}', '{$car['category']}', '{$car['price']}', 
                    '{$car['details']}', '{$car['image']}')";
    return mysqli_query($con, $sql);
}

function updateCar($car) {
    $con = getConnection();
    $sql = "UPDATE cars SET name='{$car['name']}', category='{$car['category']}', 
            price='{$car['price']}', details='{$car['details']}', image='{$car['image']}'
            WHERE id={$car['id']}";
    return mysqli_query($con, $sql);
}

function deleteCar($id) {
    $con = getConnection();
    $sql = "DELETE FROM cars WHERE id = {$id}";
    return mysqli_query($con, $sql);
}





?>
