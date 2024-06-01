<?php
require 'config/database.php';

if(isset($_POST['submit'])){
    $id= filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $title= filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description= filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // validate input
    if(!$title || !$description) {
        $_SESSION['edit-category'] = "Invalid form input on edit category page";
    }else{
        $query = "UPDATE categories SET title='$title', description='$description' WHERE id=$id LIMIT 1";
        $result = mysqli_query($con, $query);

        if(mysqli_errno($con)){
            $_SESSION['edit-category'] = "Coundn't update category";
            header('location: ' . ROOT_URL . 'admin/manage-category.php');
            die();
        }else{
            $_SESSION['edit-category-success'] = "Category $title updated successfully.";
            header('location: ' . ROOT_URL . 'admin/manage-category.php');
            die();
        }
    }
}else{
    header('location: ' . ROOT_URL . 'admin/edit-category.php');
    die();
}