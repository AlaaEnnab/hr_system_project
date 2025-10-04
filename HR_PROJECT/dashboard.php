<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}


include "side_nav_bar.php"; 
?>

<html>
<body class="d-flex flex-column min-vh-100">
<div class="d-flex flex-grow-1">


  <div class="flex-grow-1 p-4 content">
    <?php include "employee_dashboard.php"; ?>
  </div>
</div>

<div class="text-center text-muted mt-4 small">
  © 2025 HR System
</div>

<style>

.content {
  margin-left: 260px;   
  margin-top: 70px;     
}
</style>
</body>
</html>
