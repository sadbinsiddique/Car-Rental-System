<?php
    require_once('db.php');

    function login($username, $password) {
        $con = getConnection();
        
        $sql = "select * from users where username='{$username}' and password='{$password}'";
        $result = mysqli_query($con, $sql);
        $user = mysqli_fetch_assoc($result);
        
        if($user){
            return true;
        }else{
            return false;
        }
    }

    function addUser($user) {
        $con = getConnection();
        
        // Extract user data with defaults for optional fields
        $username = $user['username'];
        $password = $user['password'];
        $email = $user['email'];
        $full_name = $user['full_name'] ?? $username; // Default to username if not provided
        $phone = $user['phone'] ?? '';
        $address = $user['address'] ?? '';
        $user_type = 'customer'; // Default user type for new registrations
        
        // Use prepared statement to prevent SQL injection
        $sql = "INSERT INTO users (username, password, full_name, email, phone, address, user_type) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "sssssss", $username, $password, $full_name, $email, $phone, $address, $user_type);
        
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_close($stmt);
            return true;
        } else {
            $error = mysqli_stmt_error($stmt);
            mysqli_stmt_close($stmt);
            return false;
        }
    }

    // Get user data by username
    function getUserByUsername($username){
        $con = getConnection();
        $sql = "SELECT * FROM users WHERE username='{$username}'";
        $result = mysqli_query($con, $sql);
        $user = mysqli_fetch_assoc($result);
        return $user;
    }
    
    // Get all users
    function getAllUsers(){
        $con = getConnection();
        $sql = "SELECT * FROM users";
        $result = mysqli_query($con, $sql);
        $users = [];
        
        while($user = mysqli_fetch_assoc($result)){
            array_push($users, $user);
        }
        
        return $users;
    }
    
    // Update user information
    function updateUser($user){
        $con = getConnection();
        $sql = "UPDATE users SET 
                full_name='{$user['full_name']}', 
                email='{$user['email']}',
                phone='{$user['phone']}', 
                address='{$user['address']}' 
                WHERE id={$user['id']}
                ";
                
        if(mysqli_query($con, $sql)){
            return true;
        } else {
            return false;
        }
    }
    
    // Change user password
    function updatePassword($userId, $newPassword){
        $con = getConnection();
        $sql = "UPDATE users SET password='{$newPassword}' WHERE id={$userId}";
        
        if(mysqli_query($con, $sql)){
            return true;
        } else {
            return false;
        }
    }
    
    // Delete user
    function deleteUser($userId){
        $con = getConnection();
        $sql = "DELETE FROM users WHERE id={$userId}";
        
        if(mysqli_query($con, $sql)){
            return true;
        } else {
            return false;
        }
    }
?>