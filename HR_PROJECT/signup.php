<?php
session_start();
include "config.php";
$conn = (new Database())->connect();

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role = "admin"; 

    if (empty($username) || empty($password)) {
        $error = "Please enter username and password.";
    } else {
        // check if the user already exsist or not
        $stmt = $conn->prepare("SELECT id FROM users WHERE username=? LIMIT 1");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "Username already exists!";
        } else {
            // password encryption
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // insert new user
            $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $hashedPassword, $role);

            if ($stmt->execute()) {
                $success = "User registered successfully! You can now <a href='login.php'>Login</a>";
            } else {
                $error = "Error: " . $stmt->error;
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up - HR System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
         background: linear-gradient(to right, #f9e8b3ff, #ffc107, #ff8c42);
            height: 100vh;
        }
        .card {
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 0 25px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>
<div class="container d-flex justify-content-center align-items-center" style="height:100vh">
    <div class="col-md-5">
        <div class="card">
            <h3 class="text-center mb-4">Sign Up</h3>

            <?php if($error): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <?php if($success): ?>
                <div class="alert alert-success"><?= $success ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="username" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Sign Up</button>
                </div>
            </form>

            <p class="text-center mt-3">Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
