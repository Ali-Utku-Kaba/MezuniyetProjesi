<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.html");
    exit();
}

$request_id = $_POST['request_id'];
$action = $_POST['action'];

$status = ($action === 'approve') ? 'approved' : 'rejected';

$sql = "UPDATE contact_requests SET status = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $status, $request_id);

if ($stmt->execute()) {
    if ($status === 'approved') {
        echo "İletişim bilgileriniz talep eden öğrenci ile paylaşıldı.";
        header("Refresh: 3; url=roommate_match.php");
    } else {
        echo "İletişim bilgilerinizin talep eden öğrenci ile paylaşılmasını reddettiniz.";
        header("Refresh: 3; url=roommate_match.php");

    }
} else {
    echo "Bir hata oluştu. Lütfen tekrar deneyin.";
}

$conn->close();
?>
