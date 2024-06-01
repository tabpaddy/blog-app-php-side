<?php
include('./partials/header.php');

// fetch categories from database
$query = "SELECT * FROM categories";
$result = mysqli_query($con, $query);

// get back form data
$title = $_SESSION['add-post-data']['title'] ?? null;
$body = $_SESSION['add-post-data']['body'] ?? null;

unset($_SESSION['add-post-data']);
?>

    
    <section class="form__section">
    <div class="container form__selection-container">
        <h2>Add Post</h2>
        <?php if(isset($_SESSION['add-post'])): ?>
        <div class="alert__message error">
            <p>
                <?= $_SESSION['add-post'];
                    unset($_SESSION['add-post'])
                    ?>
            </p>
        </div>
        <?php endif ?>
        <form action="<?= ROOT_URL ?>admin/add-post-logic.php" enctype="multipart/form-data" method="post">
            <input type="text" name="title" id="" placeholder="Title" value="<?=$title?>">
            <select name="category">
            <?php while($category = mysqli_fetch_array($result)): ?>
                <option value="<?= $category['id']?>"><?= $category['title']?></option>
                <?php endwhile ?>
            </select>
            <textarea name="body" id=""  rows="10" placeholder="Body"><?=$body?></textarea>
            <?Php if(isset($_SESSION['user_is_admin'])): ?>
            <div class="form__control Featured">
                <input type="checkbox" id="is_featured" value="1" name="is_featured" checked>
                <label for="is_featured" checked>Featured</label>
            </div>
            <?php endif ?>
            <div class="form__control">
                <label for="thumbnail">Add Thumbnail</label>
                <input type="file" id="thumbnail" name="thumbnail">
            </div>
            <button type="submit" class="btn" name="submit">Add Post</button>
        </form>
    </div>
</section>



<?php
include '../partials/footer.php';
?>