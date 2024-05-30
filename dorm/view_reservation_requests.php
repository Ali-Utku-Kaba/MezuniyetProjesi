<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'dorm_owner') {
    header("Location: login.html");
    exit();
}

$dormOwnerId = $_SESSION['user_id'];

$sql = "SELECT r.*, u.name, u.surname, u.email, u.phone, d.room_name, d.annual_price, d.room_quantity
        FROM reservation_requests r
        INNER JOIN students u ON r.student_id = u.id
        INNER JOIN dorm_rooms d ON r.dorm_room_id = d.id
        WHERE d.dorm_owner_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $dormOwnerId);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yurt Odası Rezervasyonları</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body style="background-color:#f3f3f3;">
<?php include 'header.php'; ?>
<div class="container mt-5 pt-5">
    <h1 class="text-center mb-4">Yurt Odası Rezervasyonları</h1>
    <div class="row">
        <?php
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="col-md-4 mb-4">
                <div class="card bg-white">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <p class="card-text">Öğrenci: <?php echo $row['name'] . ' ' . $row['surname']; ?></p>
                        <p class="card-text">Email: <?php echo $row['email']; ?></p>
                        <p class="card-text">Telefon: <?php echo $row['phone']; ?></p>
                        <p class="card-text">İlgilenilen Oda: <?php echo $row['room_name']; ?></p>
                        <p class="card-text">İlgilenilen Odanın Fiyatı: <?php echo $row['annual_price']; ?> TL / Yıl</p>
                        <p class="card-text">İlgilenilen Odanın Mevcut Adedi: <?php echo $row['room_quantity']; ?></p>
                        <form action="delete_reservation.php" method="post">
                            <input type="hidden" name="reservation_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="btn btn-danger">Rezervasyonu Tamamla</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
</body>
</html>
