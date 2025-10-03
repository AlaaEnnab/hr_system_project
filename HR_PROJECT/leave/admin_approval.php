<?php

require_once("../auth.php");

include "../side_nav_bar.php";
include "../config.php";
$conn = (new Database())->connect();

// check validty of admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Access denied.");
}

// reject or approve
if(isset($_GET['action'], $_GET['id'])){
    $status = $_GET['action'] === 'approve' ? 'Approved' : 'Rejected';
    $id = (int)$_GET['id']; // safe fromSQL injection

    $stmt = $conn->prepare("UPDATE leaves SET status=? WHERE id=?");
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();

    header("Location: admin_approval.php");
    exit;
}

// fetch all leave request
$result = $conn->query("
    SELECT l.id, e.name, l.start_date, l.end_date, l.reason, l.status
    FROM leaves l
    JOIN employees e ON l.employee_id = e.id
    ORDER BY l.created_at DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Leave Requests - Admin Approval</title>
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
    <h2>Leave Requests</h2>

    <table class="table table-bordered">
        <tr>
            <th>Employee</th>
            <th>Start</th>
            <th>End</th>
            <th>Reason</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>

        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= $row['start_date'] ?></td>
            <td><?= $row['end_date'] ?></td>
            <td><?= htmlspecialchars($row['reason']) ?></td>
            <td><?= $row['status'] ?></td>
            <td>
                <?php if($row['status'] === 'Pending'): ?>
                    <a href="admin_approval.php?action=approve&id=<?= $row['id'] ?>" class="btn btn-success btn-sm">Approve</a>
                    <a href="admin_approval.php?action=reject&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Reject</a>
                <?php else: ?>
                    -
                <?php endif; ?>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
                </div>
            </div>
</body>
</html>
