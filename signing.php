<?php
include ('config/database.php');

$username_email = $_SESSION['signing-data']['username_email'] ?? null;
$password = $_SESSION['signing-data']['password'] ?? null;

unset($_SESSION['signing-data']);
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
        <h2>Sign In</h2>
        <?php if(isset($_SESSION['signup-success'])): ?>
            <div class="alert__message success">
                <p>
                    <?= 
                    $_SESSION['signup-success'];
                    unset($_SESSION['signup-success']);
                    ?>
                </p>
        </div>
        <?php elseif(isset($_SESSION['signing'])): ?>
            <div class="alert__message error">
                <p>
                    <?= 
                    $_SESSION['signing'];
                    unset($_SESSION['signing']);
                    ?>
                </p>
        </div>
        <?php endif ?>
        <form action="<?=ROOT_URL?>signing-logic.php" method="post">
            <input type="text" name="username_email" id="" placeholder="Username or Email" value="<?= $username_email ?>">
            <input type="password" name="password" id="" placeholder="Enter Password" value="<?= $password ?>">
            <button type="submit" class="btn" name="submit">Sign in</button>
            <small>Already have an account? <a href="<?=ROOT_URL?>signup.php">Sign Up</a></small>
        </form>
    </div>
</section>




<script src="js/main.js"></script>
</body>
</html>