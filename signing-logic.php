<?php
require 'config/database.php';

if(isset($_POST['submit'])){
    // get form data
    $username_email = filter_var($_POST['username_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    //validation
    if(!$username_email){
        $_SESSION['signing'] = "Username or Email Required";
    }elseif(!$password){
        $_SESSION['signing'] = "Password Required";
    }else{
        // fetch user from database
        $fetch_user_query = "SELECT * FROM users WHERE username='$username_email' OR email='$username_email'";
        $fetch_user_result= mysqli_query($con, $fetch_user_query);

        if(mysqli_num_rows($fetch_user_result) == 1) {
            // convert the record into assoc array
            $user_record = mysqli_fetch_assoc($fetch_user_result);
            $db_password = $user_record['password'];

            //compare form password to db password
            if(password_verify($password, $db_password)){
                //set session for access control
                $_SESSION['user-id'] = $user_record['user_id'];
                // set session idf user is an admin
                if($user_record['is_admin'] == 1){
                    $_SESSION['user_is_admin'] = true;
                }

                //log user in
                header('location: ' . ROOT_URL . 'admin/');
            }else{
                $_SESSION['signing'] = "Please password do not match";
            }
        } else {
            $_SESSION['signing'] = "User not found";
        }
    }
    // if any problem, redirect back to signin page with login data
    if(isset($_SESSION['signing'])){
        $_SESSION['signing-data'] = $_POST;
        header('location: ' . ROOT_URL . 'signing.php');
        die();
    }
}else{
    header('location: ' . ROOT_URL . 'signing.php');
    die();
}