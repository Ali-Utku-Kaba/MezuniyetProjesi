<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'dorm_owner') {
    header("Location: login.html");
    exit();
}

$dorm_owner_id = $_SESSION['user_id'];

$sql = "SELECT * FROM dorm_rooms WHERE dorm_owner_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $dorm_owner_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kendi Yurt Odalarınızı Listele</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'header.php'; ?>
</div>
    <div class="container mt-5 pt-5">
        <h2 class="text-center mb-4">Kendi Yurt Odalarınız</h2>
        <div class="row">
            <?php 

            while ($row = $result->fetch_assoc()) { 

            ?>
            <div class="col-md-6">
                <div class="card mb-3">
                    <img src="<?php echo $row['image_path']; ?>" class="card-img-top" alt="Oda Resmi">
                    <div class="card-header">
                        <?php echo $row['room_name']; ?>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Kişi Kapasitesi: <?php echo $row['capacity']; ?> Kişi</p>
                        <p class="card-text">Metrekare: <?php echo $row['size_sqm']; ?>m²</p>
                        <p class="card-text">Yıllık Fiyat: <?php echo $row['annual_price']; ?></p>
                        <p class="card-text">Mevcut Oda Sayısı: <?php echo $row['room_quantity']; ?></p>
                        <p class="card-text">Özellikler: <?php echo $row['features']; ?></p>
                        <a href="delete_room.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Yurt Odasını Sil</a>
                        <a href="edit_room.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Yurt Odasını Düzenle</a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
