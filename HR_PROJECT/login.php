<?php
session_start();
include "config.php";
$conn = (new Database())->connect();
$error = "";



if($_SERVER['REQUEST_METHOD']=== 'POST'){
     $username = trim($_POST['username']);
     $password = trim($_POST['password']);

       if (empty($username) || empty($password)) {
        $error = "Please enter both username and password.";
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE username=? LIMIT 1");
        $stmt ->bind_param("s",$username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();


        if($user && password_verify($password ,$user['password'])){
              $_SESSION['username'] = $user['username'];
              $_SESSION['role'] = $user['role'];
              header("Location: dashboard.php"); 
              exit;
        } else {
            $error = "Invalid username or password.";
        }
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - HR System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
           background: linear-gradient(to right, #f9e8b3ff, #ffc107, #ff8c42);
        }
        .card {
            border-radius: 1rem;
            box-shadow: 0 0 25px rgba(0,0,0,0.2);
            padding: 2rem;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #224abe;
        }
        .btn-primary {
            background-color: #224abe;
            border: none;
        }
        .btn-primary:hover {
            background-color: #1b347f;
        }
        .login-icon {
            font-size: 3rem;
            color: #dadde7ff;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center align-items-center" style="height:100vh">
        <div class="col-md-5">
            <div class="card text-center">
                <i class="fas fa-user-circle login-icon mb-3"></i>
                <h3 class="card-title mb-4">HR System Login</h3>
                
                <?php if($error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <form method="post" action="">
                    <div class="mb-3 text-start">
                        <label for="username" class="form-label">Username</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" required>
                        </div>
                    </div>
                    <div class="mb-3 text-start">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required>
                        </div>
                    </div>
                   <div class="d-flex gap-2">
       <button type="submit" class="btn btn-primary btn-sm">Login</button>
     <a href="signup.php" class="btn btn-secondary btn-sm">Sign Up</a>
</div>

                </form>

                <p class="text-center mt-3 text-muted">HR System &copy; 2025</p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>