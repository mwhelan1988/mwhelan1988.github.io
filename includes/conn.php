<?php
ob_start();
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



if($_SERVER["SERVER_NAME"] == "dev.whelandesigns.com") {
    //Production -  Connects to PLESK databse **
    $conn = mysqli_connect ("localhost", "soundwave_db", "*q6d7eB4", "soundwave");
} else {
    //Development/LOCAL - Connects to MAMP database **
    $conn = mysqli_connect ("localhost", "root", "root", "soundwave");
}

if(mysqli_connect_errno( $conn)){
    echo "failed to connect to MySQL: " . mysqli_connect_error();
}
?>