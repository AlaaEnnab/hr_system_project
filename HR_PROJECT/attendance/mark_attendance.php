<?php
require_once("../auth.php");
include "../side_nav_bar.php";
include ("../config.php");

$conn = (new Database())->connect();

// fetch employee
$employees = $conn->query("SELECT id, name FROM employees ORDER BY name");
$message = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $date = $_POST['attend_date'];
    $statuses = $_POST['status']; // array: employee_id => status

    foreach($statuses as $emp_id => $status){
        $stmt = $conn->prepare("INSERT INTO attendance (employee_id, date, status) VALUES (?, ?, ?)
                                ON DUPLICATE KEY UPDATE status=?");
        $stmt->bind_param("isss", $emp_id, $date, $status, $status);
        $stmt->execute();
    }
    $message = " Attendance recorded successfully for $date.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mark Attendance</title>
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
  
    <h2>Mark Daily Attendance</h2>

    <?php if($message): ?>
        <div class="alert alert-success"><?= $message ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label for="attend_date">Date:</label>
            <input type="date" name="attend_date" id="attend_date" class="form-control" required value="<?= date('Y-m-d') ?>">
        </div>

        <table class="table table-bordered">
            <tr>
                <th>Employee</th><th>Status</th>
            </tr>
            <?php while($emp = $employees->fetch_assoc()): ?>
            <tr>
                <td><?= $emp['name'] ?></td>
                <td>
                    <select name="status[<?= $emp['id'] ?>]" class="form-control">
                        <option value="Present">Present</option>
                        <option value="Absent">Absent</option>
                    </select>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>

        <button type="submit" class="btn btn-primary">Submit Attendance</button>
    </form>
            </div></div>
</body>
</html>
