<?php


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location:/HR_PROJECT/login.php"); 
    exit;
}
?>