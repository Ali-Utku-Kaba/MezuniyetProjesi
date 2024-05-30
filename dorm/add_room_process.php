<?php
session_start();
include 'config.php';
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    echo "Oturum açmış bir kullanıcı gerekli.";
    exit();
}
$dorm_owner_id = $_SESSION['user_id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roomName = $_POST['room_name'];
    $capacity = $_POST['capacity'];
    $sizeSqm = $_POST['size_sqm'];
    $annualPrice = $_POST['annual_price'];
    $room_quantity = $_POST['room_quantity'];
    $features = isset($_POST['features']) ? implode(", ", $_POST['features']) : '';
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $uploadOk = 1;
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "Dosya bir resim değil.";
        $uploadOk = 0;
    }
    if ($_FILES["image"]["size"] > 5000000) {
        echo "Üzgünüz, dosyanız çok büyük.";
        $uploadOk = 0;
    }
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Üzgünüz, yalnızca JPG, JPEG, PNG ve GIF dosyalarına izin veriliyor.";
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        echo "Üzgünüz, dosyanız yüklenemedi.";
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $imagePath = $targetFile;
            $sql = "INSERT INTO dorm_rooms (dorm_owner_id, room_name, capacity, size_sqm, annual_price, room_quantity, features, image_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isiidiss", $dorm_owner_id, $roomName, $capacity, $sizeSqm, $annualPrice, $room_quantity, $features, $imagePath);
            if ($stmt->execute()) {
                header("Location: dorm_room_list.php");
            } else {
                echo "Hata: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Üzgünüz, dosya yüklenirken bir hata oluştu.";
            header("Refresh: 3; url=dorm_owner_dashboard.php");
        }
    }
    $conn->close();
}
?>