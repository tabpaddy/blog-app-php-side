<?php
require 'config/database.php';

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    //fetch post from databe in order to delete thumbnail from image folder
    $query = "SELECT * FROM posts WHERE id=$id";
    $result = mysqli_query($con, $query);

    //make sure we have only 1 record
    if(mysqli_num_rows($result) == 1){
        $post = mysqli_fetch_assoc($result);
        $thumbnail_name = $post['thumbnail'];
        $thumbnail_path = '../image/' . $thumbnail_name;

        if($thumbnail_path){
            unlink($thumbnail_path);

            // delete post from database
            $delete_post_query ="DELETE FROM posts WHERE id=$id LIMIT 1";
            $delete_post_result = mysqli_query($con, $delete_post_query);

            if(!mysqli_errno($con)){
                $_SESSION['delete-post-success'] = "Post deleted successfully";
                header('location: ' . ROOT_URL . 'admin/');
                die();
            }
        }
    }
}else{
    header('location: ' . ROOT_URL . 'admin/');
    die();
}