<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'dorm_owner') {
    header("Location: login.html");
    exit();
}
$room_id = $_GET['id'];
$sql = "DELETE FROM dorm_rooms WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $room_id);
$stmt->execute();
header("Location: dorm_room_list.php");
?>
