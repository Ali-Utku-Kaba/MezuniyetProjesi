<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.html");
    exit();
}

$userId = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roomId = $_POST['room_id'];
    $userId = $_SESSION['user_id'];

    $sql = "INSERT INTO reservation_requests (student_id, dorm_room_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $userId, $roomId);

    if ($stmt->execute()) {
        echo "Rezervasyon talebiniz gönderildi, yurt sahibi sizinle iletişime geçecektir.";
         header("Refresh: 3; url=find_dorm_room.php"); 
    } else {
        echo "Rezervasyon talebi gönderilirken bir hata oluştu. Lütfen tekrar deneyin.";
    }
} else {
    echo "Geçersiz bir istek yapıldı.";
}

$conn->close();
?>
