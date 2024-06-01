<?php
require 'constants.php';

//connect to the database
$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if(!$con){
    die(mysqli_error($con));
}
?>