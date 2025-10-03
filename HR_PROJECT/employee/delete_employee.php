<?php
require_once("../auth.php");
include "../config.php";   


$db = new Database();
$conn = $db->connect();   

$msg = ""; 


$id = $_GET['id'] ?? 0;
if ($id) {
    $stmt = $conn->prepare("DELETE FROM employees WHERE id=?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: employees.php");
        exit;
    } else {
        echo " Error deleting employee";
    }
} else {
    echo " Invalid ID";
}
