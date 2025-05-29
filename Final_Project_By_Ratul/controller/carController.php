<?php
require_once('../model/adminModel.php');

if (isset($_GET['deleteCar'])) {
    $id = $_GET['deleteCar'];
    deleteCar($id);
    header('location: ../view/cars.php');
    exit;
}

if (isset($_POST['addCar'])) {
    $car = [
        'name' => $_POST['name'],
        'category' => $_POST['category'],
        'price' => $_POST['price'],
        'details' => $_POST['details'],
        'image' => $_POST['image']
    ];
    addCar($car);
    header('location: ../view/cars.php');
    exit;
}

if (isset($_POST['updateCar'])) {
    $car = [
        'id' => $_POST['id'],
        'name' => $_POST['name'],
        'category' => $_POST['category'],
        'price' => $_POST['price'],
        'details' => $_POST['details'],
        'image' => $_POST['image']
    ];
    updateCar($car);
    header('location: ../view/cars.php');
    exit;
}
