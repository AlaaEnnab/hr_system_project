<?php
require_once("../auth.php");
include "../side_nav_bar.php";
include "../config.php";
$conn = (new Database())->connect();
$error = $message = "";

// fetch employees list to show in dropdown
$employees = $conn->query("SELECT id, name FROM employees ORDER BY name ASC");

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $employee_id = $_POST['employee_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $reason = $_POST['reason'];

    if(empty($employee_id) || empty($start_date) || empty($end_date)){
        $error = "Please fill all required fields.";
    } else {
        $stmt = $conn->prepare("INSERT INTO leaves (employee_id, start_date, end_date, reason) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $employee_id, $start_date, $end_date, $reason);
        if($stmt->execute()){
            $message = " Leave request submitted successfully!";
        } else {
            $error = "Error: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Leave Request</title>
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
    <h2>Request Leave</h2>

    <?php if($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php elseif($message): ?>
        <div class="alert alert-success"><?= $message ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label>Employee:</label>
            <select name="employee_id" class="form-control" required>
                <option value="">-- Select Employee --</option>
                <?php while($emp = $employees->fetch_assoc()): ?>
                    <option value="<?= $emp['id'] ?>"><?= $emp['name'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Start Date:</label>
            <input type="date" name="start_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>End Date:</label>
            <input type="date" name="end_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Reason:</label>
            <textarea name="reason" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit Request</button>
    </form>
                </div></div>
</body>
</html>
