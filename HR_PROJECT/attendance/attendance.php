<?php
require_once("../auth.php");
include "../side_nav_bar.php";
include ("../config.php");
$conn = (new Database())->connect();


$result = $conn->query("SELECT id, name, email FROM employees ORDER BY name ASC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Attendance - Employees</title>
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

        <h2>Employees - Attendance Records</h2>
        <table class="table table-bordered table-striped">
            <tr>
                <th>ID</th><th>Name</th><th>Email</th><th>Actions</th>
            </tr>

            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td>
                        <a href="attendance_records.php?employee_id=<?= $row['id'] ?>" 
                           class="btn btn-sm btn-info">View Attendance</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="4" class="text-center text-muted">No employees found.</td></tr>
            <?php endif; ?>
        </table>

    </div>
</div>
</body>
</html>
