<?php
include('./partials/header.php');
//get back form data if there was an error
$firstname = $_SESSION['add-user-data']['firstname'] ?? null;
$lastname = $_SESSION['add-user-data']['lastname'] ?? null;
$username = $_SESSION['add-user-data']['username'] ?? null;
$email = $_SESSION['add-user-data']['email'] ?? null;
$password = $_SESSION['add-user-data']['password'] ?? null;
$cpassword = $_SESSION['add-user-data']['cpassword'] ?? null;



//delete session data
unset($_SESSION['add-user-data']);
?>
    
    <section class="form__section">
    <div class="container form__selection-container">
        <h2>Add User</h2>
        <?php if(isset($_SESSION['add-user'])): ?>
            <div class="alert__message error">
            <p>
                <?= $_SESSION['add-user'];
                unset($_SESSION['add-user']) ?>
            </p>
            </div>
        <?php endif ?>
        <form action="<?= ROOT_URL ?>admin/add-user-logic.php" enctype="multipart/form-data" method="post">
            <input type="text" name="firstname" id="" placeholder="First Name" value="<?= $firstname ?>">
            <input type="text" name="lastname" id="" placeholder="Last Name" value="<?= $lastname ?>">
            <input type="text" name="username" id="" placeholder="Username" value="<?= $username ?>">
            <input type="email" name="email" id="" placeholder="Email" value="<?= $email ?>">
            <input type="password" name="password" id="" placeholder="Create Password" value="<?= $password ?>">
            <input type="password" name="cpassword" id="" placeholder="Confirm Password" value="<?= $cpassword ?>">
            <select name="userrole">
                <option value="0">Author</option>
                <option value="1">Admin</option>
            </select>
            <div class="form__control">
                <label for="avatar">User Avatar</label>
                <input type="file" id="avatar" name="avatar" value="<?= $avatar ?>">
            </div>
            <button type="submit" class="btn" name="submit">Add User</button>
        </form>
    </div>
</section>



<?php
include '../partials/footer.php';
?>