<?php
require 'config/database.php';

if(isset($_POST['submit'])){
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_thumbnail_name = filter_var($_POST['previous_thumbnail_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];

    //set is_featured to 0 if it was unchecked
    $is_featured = $is_featured == 1 ?: 0;

    // check and validate input values
    if(!$title){
        $_SESSION['edit-post'] = "Couldn't update post. Invalid form data on edit post page.";
    }elseif(!$category){
        $_SESSION['edit-post'] = "Couldn't update post. Invalid form data on edit post page.";
    }elseif(!$body){
        $_SESSION['edit-post'] = "Couldn't update post. Invalid form data on edit post page.";
    }else{
        // delete exiting thumbnail if new thumbnail is available
        if($thumbnail['name']) {
            $previous_thumbnail_path = '../image/' . $previous_thumbnail_name;
            if($previous_thumbnail_path){
                unlink($previous_thumbnail_path);
            }

            // Work on new thumbnail
            // rename image
            $time = time(); // make each image upload unique using current timestamp 
            $thumbnail_name = $time.$thumbnail['name'];
            $thumbnail_tmp_name = $thumbnail['tmp_name'];
            $thumbnail_destination_path = '../image/' . $thumbnail_name;

            // make sure file is an image
            $allowed_files = ['png', 'jpg', 'jpg'];
            $extension = explode('.', $thumbnail_name);
            $extension = end($extension);
            if(in_array($extension, $allowed_files)){
                // make sure avatar is not too large (2mb+)
                if ($thumbnail['size'] < 2000000){
                    //upload avatar
                    move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
                }else{
                    $_SESSION['edit-post'] = "Coundn't update post. Thumbnail size too big. should be less than 2mb";
                }
            }else{
                $_SESSION['edit-post'] = "Coundn't update post. Thumbnail should be png, jpg or jpeg";
            }
        }
    }

    if($_SESSION['edit-post']){
        // redirect to manage from page if form was invalid
        header('location: ' . ROOT_URL . 'admin/edit-post.php');
        die();
    }else{
        // set is_featured of all posts to 0 if is_featured for this post is 1
        if($is_featured == 1){
            $zero_all_is_featured_query = "UPDATE posts SET is_featured=0";
            $zero_all_is_featured_result = mysqli_query($con, $zero_all_is_featured_query);
        }

        // set thumbnail name if a new one was uploaded, else keep old thumbnail name
        $thumbnail_to_insert = $thumbnail_name ?? $previous_thumbnail_name;

        // $query = "UPDATE posts SET title='$title', body='$body', thumbnail = '$thumbnail_to_insert', category_id=$category, is_featured=$is_featured WHERE id=$id LIMIT 1";
        $query = "UPDATE posts SET title='$title', body='$body', thumbnail='$thumbnail_to_insert', category_id=$category, is_featured=$is_featured WHERE id=$id";
        $result = mysqli_query($con, $query);
    }

    if(!mysqli_errno($con)){
        $_SESSION['edit-post-success'] = "Post updated successfully";
        header('location: ' . ROOT_URL . 'admin/');
        die();
    }
}else{
    header('location: ' . ROOT_URL . 'admin/edit-post.php');
    die();
}


