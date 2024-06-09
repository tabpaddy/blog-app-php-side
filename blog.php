<?php
include('./partials/header.php');

// fetch 9 post from post table
$query = "SELECT * FROM posts ORDER BY date_time DESC";
$posts = mysqli_query($con, $query);
?>
?>

   <section class="search__bar">
    <form action="<?= ROOT_URL ?>search.php" method="get" class="container search__bar-container">
        <div>
            <i class="uil uil-search"></i>
            <input type="search" name="search" placeholder="search">
        </div>
        <button type="submit" class="btn" name="submit">Go</button>
    </form>
   </section>

    <!-- end of Search -->
    
    <!-- show all the post -->
    <section class="post">
    <?php if(mysqli_num_rows($posts) > 0): ?>
        <div class="container post__container">
            <?php while($post = mysqli_fetch_assoc($posts)): ?>
            <article class="post">
                <div class="post__thumbnail">
                    <img src="<?=ROOT_URL?>image/<?= $post['thumbnail'] ?>" alt="eer">
                </div>
                <div class="post__info">
                <?php 
                // fetch category from categories table using category_id of post
                $category_id = $post['category_id'];
                $category_query = "SELECT * FROM categories WHERE id=$category_id";
                $category_result = mysqli_query($con, $category_query);
                $category=mysqli_fetch_assoc($category_result);
                ?>
                    <a href="<?=ROOT_URL?>category-post.php?id=<?= $post['category_id'] ?>" class="category__button"><?= $category['title'] ?></a>
                    <h3 class="post__title"><a href="<?=ROOT_URL?>post.php?id=<?=$post['id']?>"><?= $post['title'] ?></a></h3>
                    <p class="post__body">
                    <?= substr($post['body'], 0, 190) ?>...
                    </p>
                    <div class="post__author">
                        <div class="post__author-avatar">
                        <?php
                    // fetch author from users table using author_id
                    $author_id = $post['author_id'];
                    $author_query = "SELECT * FROM users WHERE user_id=$author_id";
                    $author_result = mysqli_query($con, $author_query);
                    $author = mysqli_fetch_assoc($author_result);
                    $firtsname = $author['firstname'];
                    $lastname = $author['lastname'];
                    ?>
                            <img src="<?= ROOT_URL?>image/<?=$author['avatar']?>" alt="ha">
                        </div>
                        <div class="post__author-info">
                        <h5>By: <?= "{$author['firstname']} {$author['lastname']}" ?></h5>
                            <small><?= date("M, d, Y - M:i", strtotime($post['date_time'])) ?></small>
                        </div>
                    </div>
                </div>
            </article>
            <?php endwhile ?>
        </div>
        <?php else:?>
            <div class="alert__message error"><?= "No post found" ?></div>
        <?php endif ?>
    </section>

    <!-- end of section -->

    <section class="category__buttons">
    <?php 
                // fetch category from categories table using category_id of post
                $category_query = "SELECT * FROM categories";
                $category_result = mysqli_query($con, $category_query);
                ?>
        <div class="container category__buttons-container">
            <?php while($category=mysqli_fetch_assoc($category_result)): ?>
            <a href="<?=ROOT_URL?>category-post.php?id=<?=$category['id']?>" class="category__button"><?=$category['title']?></a>
            <?php endwhile ?>
        </div>
    </section>

    <!-- end of category button -->

    <?php
include('./partials/footer.php');
?>