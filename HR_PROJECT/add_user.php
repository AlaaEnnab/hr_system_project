<?php
require_once "config.php";
$conn = (new Database())->connect();

$username = "Alaa"; 
$password = "1234";
$role = "admin";


$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $hashedPassword, $role);

if ($stmt->execute()) {
    echo " User added successfully!";
} else {
    echo " Error: " . $stmt->error;
}
