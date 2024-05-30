<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.html");
    exit();
}

include 'config.php';

$type = $_GET['type'];
$id = $_GET['id'];

if ($type == 'student') {
    $sql = "DELETE FROM students WHERE id = $id";
} elseif ($type == 'dorm_owner') {
    $sql = "DELETE FROM dorm_owners WHERE id = $id";
}

if ($conn->query($sql) === TRUE) {
    header("Location: admin_dashboard.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
