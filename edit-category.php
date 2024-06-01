<?php
include('./partials/header.php');

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // fetch category from the data base
    $query ="SELECT * FROM categories WHERE id = $id";
    $result = mysqli_query($con, $query);
    if(mysqli_num_rows($result) == 1){
        $category = mysqli_fetch_array($result);
    }
}else{
    header('location: ' . ROOT_URL . 'admin/manage-category.php');
}
?>

    
    <section class="form__section">
    <div class="container form__selection-container">
        <h2>Edit Category</h2>
        <form action="<?=ROOT_URL?>admin/edit-category-logic.php" method="post">
            <input type="hidden" name="id"  value="<?= $category['id'] ?>">
            <input type="text" name="title" id="" placeholder="Title" value="<?= $category['title'] ?>">
            <textarea name="description" id="" cols="30" rows="4" placeholder="Description"><?= $category['description'] ?></textarea>
            <button type="submit" class="btn" name="submit">Update Category</button>
        </form>
    </div>
</section>



<?php
include '../partials/footer.php';
?>