<?php
require_once("../auth.php");
include "../side_nav_bar.php";
include ("../config.php");
$conn = (new Database())->connect();

$result = $conn->query("
    SELECT p.id, e.name, p.pay_month, p.pay_year, p.basic_salary
    FROM payroll p
    JOIN employees e ON p.employee_id = e.id
    ORDER BY p.pay_year DESC, p.pay_month DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Payslips</title>
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
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h3>Payslips</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Employee</th>
                        <th>Month</th>
                        <th>Year</th>
                        <th>Basic Salary</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= $row['pay_month'] ?></td>
                            <td><?= $row['pay_year'] ?></td>
                            <td><?= number_format($row['basic_salary'], 2) ?> JD</td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
