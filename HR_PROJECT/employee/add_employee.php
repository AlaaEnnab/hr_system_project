<?php
require_once("../auth.php");
include "../side_nav_bar.php";
include "../config.php";  


$db = new Database();
$conn = $db->connect();   
$msg = "";

$departments = [];
$dept_stmt = $conn->prepare("SELECT id, name FROM departments");
$dept_stmt->execute();
$result = $dept_stmt->get_result();
while($row = $result->fetch_assoc()) {
    $departments[] = $row;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $department_id = $_POST['department_id'] ?? null;
    $salary = trim($_POST['basic_salary']);
    $hire_date = $_POST['hire_date'] ?? null;

    if ($name && $email) {
      
        $check = $conn->prepare("SELECT id FROM employees WHERE email=?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $msg = " Email already exists!";
        } else {
            $stmt = $conn->prepare("INSERT INTO employees (name, email, phone, department_id, basic_salary, hire_date) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssids", $name, $email, $phone, $department_id, $salary, $hire_date);

            if ($stmt->execute()) {
                $msg = " Employee added successfully!";
            } else {
                $msg = " Error: " . $stmt->error;
            }
        }
    } else {
        $msg = " Name and Email are required!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Employee</title>
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
  
    <h2>Add Employee</h2>

    <?php if($msg): ?>
        <div class="alert alert-info"><?= $msg ?></div>
    <?php endif; ?>

    <form method="POST" class="mt-3">
        <input type="text" name="name" class="form-control mb-2" placeholder="Name" required>
        <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
        <input type="text" name="phone" class="form-control mb-2" placeholder="Phone">
        
        <select name="department_id" class="form-control mb-2">
            <option value="">-- Select Department --</option>
            <?php foreach($departments as $dept): ?>
                <option value="<?= $dept['id'] ?>"><?= $dept['name'] ?></option>
            <?php endforeach; ?>
        </select>

        <input type="number" step="0.01" name="basic_salary" class="form-control mb-2" placeholder="Basic Salary">
        <input type="date" name="hire_date" class="form-control mb-2" placeholder="Hire Date">
        <button type="submit" class="btn btn-success">Add Employee</button>
    </form>
            </div>
            </div>
</body>
           
</html>
