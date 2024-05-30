<?php
session_start();
include 'config.php';

// Yurt sahibi olarak giriş yapmış olmalı
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'dorm_owner') {
    header("Location: login.html");
    exit();
}

// Rezervasyonun ID'sini al
$reservationId = $_POST['reservation_id'];

// Rezervasyonu veritabanından sil
$sql = "DELETE FROM reservation_requests WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $reservationId);
if ($stmt->execute()) {
    // Başarılı bir şekilde silindiğinde ana sayfaya yönlendir
    header("Location: view_reservation_requests.php");
    exit();
} else {
    // Silme başarısızsa bir hata mesajı göster
    echo "Rezervasyon silinirken bir hata oluştu.";
}
?>
