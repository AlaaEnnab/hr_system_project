<?php
require_once("../auth.php");
 include "../side_nav_bar.php"; 
include ("../config.php");
$conn = (new Database())->connect();
$message = $error = "";

// fetch all employees for dropdownlist
$employees = $conn->query("SELECT id, name FROM employees ORDER BY name ASC");

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $employee_id = $_POST['employee_id'];
    $pay_month = $_POST['pay_month'];
    $pay_year = $_POST['pay_year'];
    $basic_salary = $_POST['basic_salary'];

    if(empty($employee_id) || empty($pay_month) || empty($pay_year) || empty($basic_salary)){
        $error = "Please fill all required fields.";
    } else {
        $stmt = $conn->prepare("INSERT INTO payroll (employee_id, pay_year, pay_month, basic_salary) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiid", $employee_id, $pay_year, $pay_month, $basic_salary);
        if($stmt->execute()){
            $message = "Payroll added successfully!";
        } else {
            $error = "Error: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Payroll</title>
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
<div class="container mt-5">
      <div class="content">

    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h3>Add Payroll</h3>
        </div>
        <div class="card-body">
            <?php if($error): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>
            <?php if($message): ?>
                <div class="alert alert-success"><?= $message ?></div>
            <?php endif; ?>

            <form method="post">
                <div class="mb-3">
                    <label for="employee_id" class="form-label">Employee</label>
                    <select name="employee_id" id="employee_id" class="form-select" required>
                        <option value="">-- Select Employee --</option>
                        <?php while($emp = $employees->fetch_assoc()): ?>
                            <option value="<?= $emp['id'] ?>"><?= $emp['name'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="pay_month" class="form-label">Month</label>
                    <input type="number" name="pay_month" id="pay_month" class="form-control" min="1" max="12" required>
                </div>

                <div class="mb-3">
                    <label for="pay_year" class="form-label">Year</label>
                    <input type="number" name="pay_year" id="pay_year" class="form-control" min="2000" max="2099" required>
                </div>

                <div class="mb-3">
                    <label for="basic_salary" class="form-label">Basic Salary</label>
                    <input type="number" step="0.01" name="basic_salary" id="basic_salary" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Add Payroll</button>
            </form>
        </div>
    </div>
</div>
        
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
