<?php
require 'config/database.php';

if(isset($_POST['submit'])){
    // get form data
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS); 

    if(!$title){
        $_SESSION['add-category'] = "Enter title";
    }elseif(!$description){
        $_SESSION['add-category'] = "Enter description";
    }

    if(isset($_SESSION['add-category'])){
        //redirect back to add category with form data if theirs was invalid input
        $_SESSION['add-category-data']=$_POST;
        header('location: ' . ROOT_URL . 'admin/add-category.php');
        die();
    }else{
        //insert category into database.
        $query = "INSERT INTO categories (title, description) VALUES ('$title', '$description')";
        $result = mysqli_query($con, $query);
        if(mysqli_errno($con)){
            $_SESSION['add-category'] = "couldn't add category";
            header('location: ' . ROOT_URL . 'admin/add-category.php');
            die();
        }else{
            $_SESSION['add-category-success'] = "Category $title added successfully";
            header('location: ' . ROOT_URL . 'admin/manage-category.php');
            die();
        }
    }
}else{
    header('location: ' . ROOT_URL . 'admin/add-category.php');
    die();
}