<?php
session_start();
include 'config.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.html");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment_id'])) {
    $commentId = $_POST['comment_id'];
    $sql = "DELETE FROM Wall_Comments WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $commentId);
    $stmt->execute();
    header("Location: wall.php");
    exit();
} else {
    echo "Invalid request.";
}
?>
