<?php
require_once("../auth.php");
include "../side_nav_bar.php";
include "../config.php";
$conn = (new Database())->connect();
$msg = "";


$departments = [];
$dept_stmt = $conn->prepare("SELECT id, name FROM departments");
$dept_stmt->execute();
$result = $dept_stmt->get_result();
while($row = $result->fetch_assoc()) {
    $departments[] = $row;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM employees WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $employee = $stmt->get_result()->fetch_assoc();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $department_id = $_POST['department_id'] ?? null;
    $salary = $_POST['basic_salary'];
    $hire_date = $_POST['hire_date'];

    $stmt = $conn->prepare("UPDATE employees SET name=?, email=?, phone=?, department_id=?, basic_salary=?, hire_date=? WHERE id=?");
    $stmt->bind_param("sssidsi", $name, $email, $phone, $department_id, $salary, $hire_date, $id);

    if ($stmt->execute()) {
        $msg = " Employee updated successfully!";
      
        $stmt2 = $conn->prepare("SELECT * FROM employees WHERE id=?");
        $stmt2->bind_param("i", $id);
        $stmt2->execute();
        $employee = $stmt2->get_result()->fetch_assoc();
    } else {
        $msg = " Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Employee</title>
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
  
    <h2>Edit Employee</h2>

    <?php if($msg): ?>
        <div class="alert alert-info"><?= $msg ?></div>
    <?php endif; ?>

    <?php if(isset($employee)): ?>
        <form method="POST" class="mt-3">
            <input type="hidden" name="id" value="<?= $employee['id'] ?>">
            <input type="text" name="name" class="form-control mb-2" value="<?= $employee['name'] ?>" required>
            <input type="email" name="email" class="form-control mb-2" value="<?= $employee['email'] ?>" required>
            <input type="text" name="phone" class="form-control mb-2" value="<?= $employee['phone'] ?>">

            <select name="department_id" class="form-control mb-2">
                <option value="">-- Select Department --</option>
                <?php foreach($departments as $dept): ?>
                    <option value="<?= $dept['id'] ?>" <?= ($dept['id'] == $employee['department_id']) ? 'selected' : '' ?>>
                        <?= $dept['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <input type="number" step="0.01" name="basic_salary" class="form-control mb-2" value="<?= $employee['basic_salary'] ?>">
            <input type="date" name="hire_date" class="form-control mb-2" value="<?= $employee['hire_date'] ?>">
            <button type="submit" class="btn btn-success">Update Employee</button>
        </form>
    <?php else: ?>
        <p class="text-danger"> Employee not found.</p>
    <?php endif; ?>
    </div>
    </div>
</body>
</html>
