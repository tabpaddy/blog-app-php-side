<?php
include('./partials/header.php');

// fetch post dta from database if is is set
if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM posts WHERE id=$id";
    $result = mysqli_query($con, $query);
    $post = mysqli_fetch_array($result);

    $author_id = $post['author_id'];
    $author_query = "SELECT * FROM users WHERE user_id=$author_id";
    $author_result = mysqli_query($con, $author_query);
    $author = mysqli_fetch_array($author_result);
}else{
    header('location: ' . ROOT_URL . 'index.php');
    die();
}
?>

    <section class="singlepost">
        <div class="container singlepost__container">
            <h2><?=$post['title']?></h2>
            <div class="post__author">
                <div class="post__author-avatar">
                    <img src="<?=ROOT_URL?>/image/<?= $author['avatar'] ?>" alt="ha">
                </div>
                <div class="post__author-info">
                    <h5>By: <?= "{$author['firstname']} {$author['lastname']}" ?></h5>
                    <small><?= date("M, d, Y - H:i", strtotime($post['date_time'])) ?></small>
                </div>
            </div>
            <div class="singlepost__thumbnail">
                <img src="<?=ROOT_URL?>image/<?= $post['thumbnail'] ?>" alt="hssu">
            </div>
            <p>
                <?= $post['body'] ?>
            </p>
        </div>
    </section>

    <!--end of single post -->

 



    <?php
include('./partials/footer.php');
?>