<?php
require_once("../auth.php");
include "../side_nav_bar.php"; 
include ("../config.php");
$conn = (new Database())->connect();

// fetch dapartments with all employees in it
$result = $conn->query("
    SELECT d.id, d.name, COUNT(e.id) AS employee_count
    FROM departments d
    LEFT JOIN employees e ON d.id = e.department_id
    GROUP BY d.id, d.name
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Departments</title>
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
    <h2>Departments</h2>
    <a href="add_department.php" class="btn btn-primary mb-3">+ Add Department</a>
    <table class="table table-bordered table-striped">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Employees</th>
            <th>Actions</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['employee_count'] ?></td>
            <td>
                <a href="../departments/view_departments.php?id=<?= $row['id'] ?>" class="btn btn-info btn-sm">View Employees</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
        </div></div>
</html>
