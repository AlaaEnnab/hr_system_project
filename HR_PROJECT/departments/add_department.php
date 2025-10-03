<?php
require_once("../auth.php");
include "../side_nav_bar.php";
include ("../config.php");
$conn = (new Database())->connect();
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    if (!empty($name)) {
        $stmt = $conn->prepare("INSERT INTO departments (name) VALUES (?)");
        $stmt->bind_param("s", $name);
        if ($stmt->execute()) {
            $message = " Department added successfully!";
        } else {
            $message = " Error: " . $stmt->error;
        }
    } else {
        $message = " Please enter department name.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Department</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<style>
       
    .content {
      margin-left: 260px;
      padding: 25px;
      margin-top: 50px;
    }
</style>
</head>
<body class="bg-light">
<div class="container mt-5">
      <div class="content">
  
    <h2>Add Department</h2>
    <?php if($message): ?>
        <div class="alert alert-info"><?= $message ?></div>
    <?php endif; ?>
    <form method="post">
        <input type="text" name="name" class="form-control mb-2" placeholder="Department Name" required>
        <button type="submit" class="btn btn-primary">Add Department</button>
        <a href="departments.php" class="btn btn-secondary">Back</a>
    </form>
    </div>
    </div>
</body>
</html>
