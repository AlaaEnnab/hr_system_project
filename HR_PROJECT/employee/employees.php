<?php
require_once("../auth.php");
include "../side_nav_bar.php";
include ("../config.php");

$conn = (new Database())->connect();
$result = $conn->query(
   " SELECT e.id, e.name, e.email, e.basic_salary, d.name AS department
    FROM employees e
    LEFT JOIN departments d ON e.department_id = d.id
    ORDER BY e.id DESC
");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee List</title>
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
  
    <h2>Employee List</h2>
    <a href="add_employee.php" class="btn btn-primary mb-3">+ Add Employee</a>
    <a href="attendance/attendance_records.php?employee_id=<?= $row['id'] ?>" class="btn btn-info btn-sm">View Attendance</a>

    <table class="table table-bordered table-striped">
        <tr>
            <th>Name</th><th>Email</th><th>Department</th><th>Salary</th><th>Actions</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
        
            <td><?= $row['name'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['department'] ?></td> 
            <td><?= $row['basic_salary'] ?></td>
            <td>
                <a href="edit_employee.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="delete_employee.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this employee?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
        </div></div>
</body>
</html>