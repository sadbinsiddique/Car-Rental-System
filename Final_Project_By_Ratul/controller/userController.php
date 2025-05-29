<?php
require_once('../model/adminModel.php');


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    deleteUser($id);
    header('location: ../view/admin.php');
    exit;
}


if (isset($_POST['add'])) {
    $user = [
        'firstname' => $_POST['firstname'],
        'lastname' => $_POST['lastname'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'dob' => $_POST['dob'],
        'license' => $_POST['license']
    ];
    addUser($user);
    header('location: ../view/admin.php');
    exit;
}


if (isset($_POST['update'])) {
    $user = [
        'id' => $_POST['id'],
        'firstname' => $_POST['firstname'],
        'lastname' => $_POST['lastname'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'dob' => $_POST['dob'],
        'license' => $_POST['license']
    ];
    updateUser($user);
    header('location: ../view/admin.php');
    exit;
}
?>
