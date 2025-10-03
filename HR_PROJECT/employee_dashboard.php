<?php
include "config.php";
$conn = (new Database())->connect();

// number of employees
$totalEmployees = $conn->query("SELECT COUNT(*) as total FROM employees")->fetch_assoc()['total'];

// number of departments
$totalDepartments = $conn->query("SELECT COUNT(*) as total FROM departments")->fetch_assoc()['total'];

// number of pending leaves
$pendingLeaves = $conn->query("SELECT COUNT(*) as total FROM leaves WHERE status='Pending'")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - HR System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card { cursor: pointer; transition: 0.3s; }
        .card:hover { transform: scale(1.05); }
        .content {
       margin-left:260px; 
      padding: 25px;
      margin-top: 50px;
    }
    </style>
</head>
<body class="bg-light">
<div class="container mt-5">
      <div class="content">
    <h2 class="mb-4">Dashboard</h2>

   <div class="row g-4 justify-content-center">
        <div class="col-md-4">
            <div class="card text-center shadow-sm bg-primary text-white p-3">
                <h4>Total Employees</h4>
                <h2><?= $totalEmployees ?></h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center shadow-sm bg-success text-white p-3">
                <h4>Total Departments</h4>
                <h2><?= $totalDepartments ?></h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center shadow-sm bg-warning text-dark p-3">
                <h4>Pending Leaves</h4>
                <h2><?= $pendingLeaves ?></h2>
            </div>
        </div>
    </div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
