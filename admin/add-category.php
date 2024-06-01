<?php
include('./partials/header.php');

// get back form data if invalid
$title = $_SESSION['add-category-data']['title'] ?? null;
$description = $_SESSION['add-category-data']['description'] ?? null;

unset($_SESSION['add-category-data']);
?>

    
<section class="form__section">
    <div class="container form__selection-container">
        <h2>ADD Category</h2>
        <?php if(isset($_SESSION['add-category'])): // show if edit user was not successful?>
            <div class="alert__message error">
                <p>
                    <?= 
                    $_SESSION['add-category'];
                    unset($_SESSION['add-category']);
                    ?>
                </p>
        </div>
        <?php endif ?>
        <form action="<?=ROOT_URL?>admin/add-category-logic.php" method="post">
            <input type="text" name="title" id="" placeholder="Title" value="<?= $title ?>">
            <textarea name="description" id="" cols="30" rows="4" placeholder="Description" value="<?= $description ?>"></textarea>
            <button type="submit" class="btn" name="submit">Update Category</button>
        </form>
    </div>
</section>



<?php
include '../partials/footer.php';
?>