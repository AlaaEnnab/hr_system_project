<?php
require_once("../auth.php");
include "../side_nav_bar.php";
 include ("../config.php");
$conn = (new Database())->connect();


$employee_id = $_GET['employee_id'] ?? 0;

// fetch employee
$stmt = $conn->prepare("SELECT name FROM employees WHERE id=?");
$stmt->bind_param("i", $employee_id);
$stmt->execute();
$employee = $stmt->get_result()->fetch_assoc();

if (!$employee) {
    die("Employee not found.");
}

// fetch attendence
$stmt = $conn->prepare("SELECT date, status FROM attendance WHERE employee_id=? ORDER BY date DESC");
$stmt->bind_param("i", $employee_id);
$stmt->execute();
$records = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Attendance Records - <?= $employee['name'] ?></title>
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
  
    <h2>Attendance Records for <?= $employee['name'] ?></h2>
    <a href="attendance.php" class="btn btn-secondary mb-3">⬅ Back</a>

    <table class="table table-bordered">
        <tr>
            <th>Date</th><th>Status</th>
        </tr>
        <?php while($row = $records->fetch_assoc()): ?>
        <tr>
            <td><?= $row['date'] ?></td>
            <td><?= $row['status'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
        </div>
    </div>
</body>
</html>
