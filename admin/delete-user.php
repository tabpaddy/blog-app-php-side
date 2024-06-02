<?php
require 'config/database.php';

if(isset($_GET['id'])){
    // fetch user from database
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // fetch user from database
    $query = "SELECT * FROM users WHERE user_id=$id";
    $result = mysqli_query($con, $query);
    $user = mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result) == 1) {
        $avatar_name = $user['avatar'];
        $avatar_path = '../image/' . $avatar_name;

        // delete image if available
        if($avatar_path){
            unlink($avatar_path);
        }

        //for later
        // fetch all thumbnails of user's post and delete them
        $thumbnail_query = "SELECT thumbnail FROM posts WHERE author_id=$id";
        $thumbnail_result = mysqli_query($con, $thumbnail_query);
        if(mysqli_num_rows($thumbnail_result) > 0){
            while($thumbnail = mysqli_fetch_assoc($thumbnail_result)) {
                $thumbnail_path = '../image/' . $thumbnail['thumbnail'];
                //delete thumbnail from images folder if exit
                if($thumbnail_path) {
                    unlink($thumbnail_path);
                }
            }
        }


        // delete user from database
        $delete_user_query = "DELETE FROM users WHERE user_id=$id";
        $delete_user_result = mysqli_query($con, $delete_user_query);
        if(mysqli_errno($con)) {
            $_SESSION['delete-user'] = "couldn't delete {$user['firstname']} {$user['lastname']}";
        }else{
            $_SESSION['delete-user-success'] = "User {$user['firstname']} {$user['lastname']} successfully deleted.";
        }
    }
}

header('location: ' . ROOT_URL . 'admin/manage-user.php');
die();