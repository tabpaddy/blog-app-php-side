<?php
include ('config/database.php');

//get back form data if there was a registartion error
$firstname = $_SESSION['signup-data']['firstname'] ?? null;
$lastname = $_SESSION['signup-data']['lastname'] ?? null;
$username = $_SESSION['signup-data']['username'] ?? null;
$email = $_SESSION['signup-data']['email'] ?? null;
$password = $_SESSION['signup-data']['password'] ?? null;
$cpassword = $_SESSION['signup-data']['cpassword'] ?? null;
$avatar = $_SESSION['signup-data']['avatar'] ?? null;

//delete signup data session
unset($_SESSION['signup-data']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Website</title>
    <!-- custom css -->
    <link rel="stylesheet" href="<?=ROOT_URL?>css/style.css">
    <!-- icon scout -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>

    
    <section class="form__section">
    <div class="container form__selection-container">
        <h2>Sign Up</h2>
        <?php if(isset($_SESSION['signup'])): ?>
                <div class="alert__message error">
                    <p>
                        <?= $_SESSION['signup'];
                        unset($_SESSION['signup']);
                        ?> 
                    </p>
                </div>  
        <?php endif ?>
        <form action="<?=ROOT_URL?>signup-logic.php" enctype="multipart/form-data" method="post">
            <input type="text" name="firstname" id="" placeholder="First Name" value="<?= $firstname ?>">
            <input type="text" name="lastname" id="" placeholder="Last Name" value="<?= $lastname ?>">
            <input type="text" name="username" id="" placeholder="Username" value="<?= $username ?>">
            <input type="email" name="email" id="" placeholder="Email" value="<?= $email ?>">
            <input type="password" name="password" id="" placeholder="Create Password" value="<?= $password ?>">
            <input type="password" name="cpassword" id="" placeholder="Confirm Password" value="<?= $cpassword ?>">
            <div class="form__control">
                <label for="avatar">Avatar</label>
                <input type="file" name="avatar" id="avatar" value="<?= $avatar ?>">
            </div>
            <button type="submit" class="btn" name="submit">Sign Up</button>
            <small>Already have an account? <a href="<?=ROOT_URL?>signing.php">Sign In</a></small>
        </form>
    </div>
</section>




<script src="js/main.js"></script>
</body>
</html>