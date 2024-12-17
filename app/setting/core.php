<?php
session_start();

if (file_exists('setting/core.php')) {
    include('setting/core.php');
} else {
    die("Error: 'core.php' file not found in the 'setting' folder.");
}

function isLogin() {
    if (!isset($_SESSION["userId"])) {
        header("Location: login.php");
        exit; 
    }
}

?>
