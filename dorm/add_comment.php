<?php
session_start();
include 'config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_SESSION['user_id'];
    $userName = $_SESSION['user_name'];
    $userSurname = $_SESSION['user_surname'];
    $postId = $_POST['post_id'];
    $comment = $_POST['comment'];
    $isAnonymous = isset($_POST['anonymous']) ? 1 : 0;
    $sql = "SELECT name, surname FROM Students WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $userName = $row['name'];
    $userSurname = $row['surname'];
    $sql = "INSERT INTO Wall_Comments (user_id, user_name, user_surname, post_id, comment, is_anonymous) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issisi", $userId, $userName, $userSurname, $postId, $comment, $isAnonymous);
    $stmt->execute();
    header("Location: wall.php");
    exit();
}
?>