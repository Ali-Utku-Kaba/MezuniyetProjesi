<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.html");
    exit();
}

$requester_id = $_SESSION['user_id'];
$requested_id = $_POST['requested_id'];

$sql = "INSERT INTO contact_requests (requester_id, requested_id, status) VALUES (?, ?, 'pending')";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $requester_id, $requested_id);

if ($stmt->execute()) {
    echo "İletişim bilgilerini talep ettiniz. Onayladığı zaman aynı ekranda talep ettiğiniz kullanıcının iletişim bilgilerini görüntüleyebileceksiniz.";
    header("Refresh: 3; url=roommate_match.php"); 
} else {
    echo "Bir hata oluştu. Lütfen tekrar deneyin.";
}

$conn->close();
?>
