<?php
require 'config/database.php';


if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    //for later
    // update category_id of post thta belong to this category to id of uncategorized category

    // delete category
    $query = "DELETE FROM categories WHERE id=$id LIMIT 1";
    $result = mysqli_query($con, $query);
    $_SESSION['delete-category-success'] = "Category deleted successfully";
}else{
    header('location: ' . ROOT_URL . 'admin/manage-category.php');
    die();
}

header('location: ' . ROOT_URL . 'admin/manage-category.php');
die();