<?php
session_start();
if (!isset($_SESSION['uname']) || !isset($_SESSION['pass'])) {
    header("Location: login.php");
    exit();
}
?>