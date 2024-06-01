<?php
include('./partials/header.php');

// fetch categories from database
$category_query = "SELECT * FROM categories";
$category_result = mysqli_query($con, $category_query);


// fetch form with id
if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE id=$id";
    $result = mysqli_query($con, $query);
    $post = mysqli_fetch_assoc($result);
}else{
    header('location: ' . ROOT_URL . 'admin/');
}

?>

    
    <section class="form__section">
    <div class="container form__selection-container">
        <h2>Edit Post</h2>
        <?php if(isset($_SESSION['edit-post'])): ?>
        <div class="alert__message error">
            <p>
                <?= $_SESSION['edit-post'];
                    unset($_SESSION['edit-post'])
                    ?>
            </p>
        </div>
        <?php endif ?>
        <form action="edit-post-logic.php" enctype="multipart/form-data" method="post">
            <input type="hidden" name="id" value="<?= $post['id'] ?>">
            <input type="hidden" name="previous_thumbnail_name" value="<?= $post['thumbnail'] ?>">
            <input type="text" name="title" id="" placeholder="Title" value="<?= $post['title'] ?>">
            <select name="category">
                <?php while($category = mysqli_fetch_assoc($category_result)): ?>
                <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                <?php endwhile ?>
            </select>
            <textarea id=""  rows="10" placeholder="Body" name="body"><?= $post['body'] ?></textarea>
            <div class="form__control Featured">
                <input type="checkbox" id="is_featured" checked name="is_featured" value="1">
                <label for="is_featured">Featured</label>
            </div>
            <div class="form__control">
                <label for="thumbnail">Change Thumbnail</label>
                <input type="file" id="thumbnail" name="thumbnail">
            </div>
            <button type="submit" class="btn" name="submit">Update Post</button>
        </form>
    </div>
</section>



<?php
include '../partials/footer.php';
?>