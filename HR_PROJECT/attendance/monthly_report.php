<?php
require_once("../auth.php");
include "../side_nav_bar.php";
include ("../config.php");

$conn = (new Database())->connect();

$month = $_GET['month'] ?? date('m');  
$year = $_GET['year'] ?? date('Y');  

$sql = "
    SELECT e.name, a.date, a.status
    FROM attendance a
    JOIN employees e ON a.employee_id = e.id
    WHERE MONTH(a.date)=? AND YEAR(a.date)=?
    ORDER BY e.name, a.date
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $month, $year);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Monthly Attendance Report</title>
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
    <h2>Attendance Report for <?= "$year-$month" ?></h2>
    <table class="table table-bordered">
        <tr>
            <th>Employee</th><th>Date</th><th>Status</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['name'] ?></td>
            <td><?= $row['date'] ?></td>
            <td><?= $row['status'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
        </div></div>
</body>
</html>
