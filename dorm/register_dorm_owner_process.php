<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $username = $_POST['username'];
    $dormName = $_POST['dormName'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dormWebsite = $_POST['dormWebsite'];
    $dormContactNumber = $_POST['dormContactNumber'];
    $dormEmail = $_POST['dormEmail'];
    $dormAddress = $_POST['dormAddress'];
    $dormFeatures = isset($_POST['dormFeatures']) ? implode(", ", $_POST['dormFeatures']) : '';
    $dormRating = 0;
    $dormReviews = '';
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

            $sql = "INSERT INTO dorm_owners (name, surname, username, dormName, password, email, phone, dormWebsite, dormContactNumber, dormEmail, dormAddress, dormFeatures, dormImage, dormRating, dormReviews) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssssssssssss", $name, $surname, $username, $dormName, $password, $email, $phone, $dormWebsite, $dormContactNumber, $dormEmail, $dormAddress, $dormFeatures, $imagePath, $dormRating, $dormReviews);
        
            if ($stmt->execute()) {
                echo "Kayıt başarılı. Giriş yapabilmeniz için profilinizin yönetici tarafından doğrulanması gerekmektedir.";
                header("Refresh: 3; url=login.html"); 
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }     
        } else {
            echo "Üzgünüz, dosya yüklenirken bir hata oluştu.";
        }
    }

    $conn->close();
}
?>
