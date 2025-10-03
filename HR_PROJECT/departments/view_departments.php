<?php
require_once("../auth.php");
include "../side_nav_bar.php";
include ("../config.php");
$conn = (new Database())->connect();

$dept_id = $_GET['id'] ?? 0;

// fetch department
$stmt = $conn->prepare("SELECT * FROM departments WHERE id=?");
$stmt->bind_param("i", $dept_id);
$stmt->execute();
$result = $stmt->get_result();
$department = $result->fetch_assoc();

if (!$department) {
    die("<div style='margin:20px; color:red; font-weight:bold;'> Department not found.</div>
         <a href='departments.php'>⬅ Back to Departments</a>");
}

// fetch all employees in department
$stmt = $conn->prepare("
    SELECT id, name, email, basic_salary, hire_date 
    FROM employees 
    WHERE department_id=?
");
$stmt->bind_param("i", $dept_id);
$stmt->execute();
$employees = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Department - <?= htmlspecialchars($department['name']) ?></title>
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
    <h2>Department: <?= htmlspecialchars($department['name']) ?></h2>
    <a href="departments.php" class="btn btn-secondary mb-3">⬅ Back</a>
    
    <table class="table table-bordered table-striped">
        <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>Salary</th><th>Hire Date</th>
        </tr>
        <?php if ($employees->num_rows > 0): ?>
            <?php while($row = $employees->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['basic_salary'] ?></td>
                <td><?= $row['hire_date'] ?></td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="5" class="text-center text-muted">No employees in this department.</td></tr>
        <?php endif; ?>
    </table>
        </div></div>
</body>
</html>
