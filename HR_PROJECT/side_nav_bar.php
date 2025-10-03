<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;

    }

    /* Navbar */
    .navbar {
      height: 50px;
      font-size: 14px;
    }

    /* Sidebar */
    .sidebar {
      position: fixed;
      top: 50px;  
      left: 0;
      width: 260px;
      height: calc(100vh - 50px); 
     background: linear-gradient(180deg, #f5f5f5, #d1d1d1);
    color: #333;
      overflow-y: auto;
      padding-top: 15px;
    }

    .sidebar a {
      display: block;
     color: #333;
      padding: 12px 20px;
      text-decoration: none;
      font-size: 1rem;
      border-left: 4px solid transparent;
      transition: all 0.2s ease;
    }

    .sidebar a:hover {
  background: rgba(0, 0, 0, 0.05); 
}

    .sidebar .collapse a {
      padding-left: 40px;
      font-size: 0.95rem;
    }

    .sidebar h6 {
      color: #ddd;
      font-size: 0.8rem;
      padding: 0 20px;
      margin-top: 15px;
      text-transform: uppercase;
    }

    .sidebar a i {
      margin-right: 10px;
    }


    @media (max-width: 768px) {
      .sidebar {
        width: 100%;
        height: auto;
        position: relative;
      }
      .content {
        margin-left: 0;
      }
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="dashboard.php">HR System</a>
    <div class="d-flex">
      <span class="navbar-text text-white me-3">
        👤 <?php echo $_SESSION['username'] ?? 'Guest'; ?> 
        (<?php echo $_SESSION['role'] ?? 'employee'; ?>)
      </span>
      <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
    </div>
  </div>
</nav>

<!-- Sidebar -->
<div class="sidebar">

    <a  href="/HR_PROJECT/dashboard.php" role="button" aria-expanded="false"><i class="fas fa-users"></i> Dashboard</a>

  <a data-bs-toggle="collapse" href="#empMenu" role="button" aria-expanded="false"><i class="fas fa-users"></i> Employees</a>
  <div class="collapse" id="empMenu">
    <a href="/HR_PROJECT/employee/add_employee.php">Add Employee</a>
    <a href="/HR_PROJECT/employee/employees.php"> View Employees</a>
  </div>

 
  <a data-bs-toggle="collapse" href="#deptMenu" role="button" aria-expanded="false"><i class="fas fa-building"></i> Departments</a>
  <div class="collapse" id="deptMenu">
   <a href="/HR_PROJECT/departments/departments.php"> Departments</a>
   <a href="/HR_PROJECT/departments/add_department.php">Add Department</a>
  </div>

 
  <a data-bs-toggle="collapse" href="#attMenu" role="button" aria-expanded="false"><i class="fas fa-calendar-check"></i> Attendance</a>
  <div class="collapse" id="attMenu">
     <a href="/HR_PROJECT/attendance/attendance.php">attendance</a>
    <a href="/HR_PROJECT/attendance/mark_attendance.php"> Mark Attendance</a>
     <a href="/HR_PROJECT/attendance/monthly_report.php"> monthly_report</a>
  </div>


  <a data-bs-toggle="collapse" href="#leaveMenu" role="button" aria-expanded="false"><i class="fas fa-envelope"></i> Leaves</a>
  <div class="collapse" id="leaveMenu">
    <a href="/HR_PROJECT/leave/leave_request.php"> Request Leave</a>
    <a href="/HR_PROJECT/leave/admin_approval.php">Admin Approval</a>
  </div>


  <a data-bs-toggle="collapse" href="#repMenu" role="button" aria-expanded="false"><i class="fas fa-chart-bar"></i> Reports</a>
  <div class="collapse" id="repMenu">
    <a href="/HR_PROJECT/reports/simple_report.php"> Simple Report</a>
    
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
