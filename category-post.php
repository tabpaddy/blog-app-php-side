<?php
include('./partials/header.php');

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    $query= "SELECT * FROM categories WHERE id=$id";
    $result = mysqli_query($con, $query);
    $fetch = mysqli_fetch_assoc($result);
    $category_id = $fetch['id'];


    $category_post = "SELECT * FROM posts WHERE category_id=$category_id ORDER BY date_time DESC";
    $category_result = mysqli_query($con, $category_post);

}else{
    header('location: ' .ROOT_URL . 'index.php');
    die();
}
?>

    <header class="category__title">
        <h2>Category <?=$fetch['title']?></h2>
    </header>
    <!-- end of category title -->

  
    
    <section class="post">
    <?php if(mysqli_num_rows($category_result) > 0): ?>
        <div class="container post__container">
            <?php while($post = mysqli_fetch_assoc($category_result)): ?>
            <article class="post">
                <div class="post__thumbnail">
                    <img src="<?=ROOT_URL?>image/<?=$post['thumbnail']?>" alt="eer">
                </div>
                <div class="post__info">
                    
                    <h3 class="post__title"><a href="<?=ROOT_URL?>post.php?id=<?=$post['id']?>"><?=$post['title']?></a></h3>
                    <p class="post__body">
                        <?= substr($post['body'], 0, 150)?>...
                    </p>
                    <div class="post__author">
                        <?php 
                                $author_id = $post['author_id'];

                                $author_query = "SELECT * FROM users WHERE user_id=$author_id";
                                $author_result = mysqli_query($con, $author_query);
                                $author = mysqli_fetch_array($author_result);
                        ?>
                        <div class="post__author-avatar">
                            <img src="<?=ROOT_URL?>image/<?= $author['avatar'] ?>" alt="ij">
                        </div>
                        <div class="post__author-info">
                            <h5>By: <?= "{$author['firstname']} {$author['lastname']}" ?></h5>
                            <small><?= date("M, d, Y - H:i", strtotime($post['date_time'])) ?></small>
                        </div>
                    </div>
                </div>
            </article>
            <?php endwhile?>
        </div>
        <?php else:?>
            <div class="alert__message error"><?= "No post in this category found" ?></div>
        <?php endif ?>
    </section>

    <!-- end of section -->

    <section class="category__buttons">
    <?php 
                // fetch category from categories table using category_id of post
                $categorys_query = "SELECT * FROM categories";
                $categorys_result = mysqli_query($con, $categorys_query);
                ?>
        <div class="container category__buttons-container">
            <?php while($categorys = mysqli_fetch_assoc($categorys_result)):?>
            <a href="<?= ROOT_URL?>category-post.php?id=<?= $categorys['id'] ?>" class="category__button"><?= $categorys['title'] ?></a>
            <?php endwhile ?>
        </div>
    </section>

    <!-- end of category button -->

    <?php
include('./partials/footer.php');
?>