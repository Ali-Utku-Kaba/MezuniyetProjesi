<?php
session_start();
include 'config.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.html");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['post_id'])) {
    $postId = $_POST['post_id'];
    $sql = "DELETE FROM wall_comments WHERE post_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $postId);
    $stmt->execute();
    $sql = "DELETE FROM wall_posts WHERE post_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $postId);
    $stmt->execute();
    header("Location: wall.php");
    exit();
} else {
    echo "Invalid request.";
}
?>
