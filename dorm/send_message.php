<?php
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $dorm_id = $_POST['dorm_id'];
    $type = $_POST['type'];
    $message = $_POST['message'];

    $sql = "INSERT INTO messages (user_id, dorm_id, type, message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiss", $user_id, $dorm_id, $type, $message);

    if ($stmt->execute()) {
        echo "Mesaj ilgili yurt ekibine iletildi.";
        header("Refresh: 3; url=find_dorm_room.php"); 
    } else {
        echo "Mesaj gönderilirken bir hata oluştu: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
