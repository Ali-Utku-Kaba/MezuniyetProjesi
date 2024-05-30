<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'student') {
        $student_id = $_SESSION['user_id'];
        $dorm_id = $_POST['dorm_id'];
        $comment = $_POST['comment'];

        $sql = "INSERT INTO dorm_comments (dorm_id, student_id, comment) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $dorm_id, $student_id, $comment);

        if ($stmt->execute()) {
            header("Location: dorm_comments.php?dorm_id=$dorm_id&lang=" . $_SESSION['lang']);
            exit();
        } else {
            echo "Yorum eklenirken bir hata oluştu.";
        }
    } else {
        echo "Yorum yapabilmek için giriş yapmalısınız.";
    }
} else {
    echo "Geçersiz istek.";
}
?>
