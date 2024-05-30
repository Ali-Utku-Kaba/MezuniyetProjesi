<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}
$role = $_SESSION['role'];
if ($role === 'admin') {
    header("Location: admin_dashboard.php");
} elseif ($role === 'student') {
    header("Location: student_dashboard.php");
} elseif ($role === 'dorm_owner') {
    header("Location: dorm_owner_dashboard.php");
} else {
    session_destroy();
    header("Location: login.html");
}
?>
