<?php
 require_once("../auth.php");
  include "../side_nav_bar.php"; 
 include '../config.php';
 $conn = (new Database())->connect();


// fetch employees with their departments
$employeesByDept = $conn->query("
    SELECT e.name as employee_name, d.name as department_name
    FROM employees e
    LEFT JOIN departments d ON e.department_id = d.id
    ORDER BY d.name ASC, e.name ASC
");
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employees by Department</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>

 .content {
      margin-left: 260px;
      padding: 25px;
      margin-top: 50px;
    }

</style>
</head>
<body class="bg-light">
    <div class="content">
<div class="container mt-5">
    <h3>Employees by Department</h3>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Employee</th>
                <th>Department</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $employeesByDept->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['employee_name']) ?></td>
                    <td><?= htmlspecialchars($row['department_name'] ?? 'Unassigned') ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
            </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>