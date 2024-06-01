<?php
include('./partials/header.php');

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM users WHERE user_id=$id";
    $result = mysqli_query($con, $query);
    $user = mysqli_fetch_assoc($result);
}else{
    header('location: '. ROOT_URL . 'admin/manage-user.php');
}
?>

    
    <section class="form__section">
    <div class="container form__selection-container">
        <h2>Edits User</h2>
        
        <form action="<?= ROOT_URL ?>admin/edit-user-logic.php" method="post">
            <input type="hidden" value="<?=$user['user_id']?>" name="user_id">
            <input type="text" name="firstname" id="" placeholder="First Name" value="<?=$user['firstname']?>">
            <input type="text" name="lastname" id="" placeholder="Last Name" value="<?=$user['lastname']?>">     
            <select name="userrole" id="">
                <option value="0">Author</option>
                <option value="1">Admin</option>
            </select>
            <button type="submit" class="btn" name="submit">Update User</button>
        </form>
    </div>
</section>



<?php
include '../partials/footer.php';
?>