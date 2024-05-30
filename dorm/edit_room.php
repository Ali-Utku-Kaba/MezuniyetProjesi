<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'dorm_owner') {
    header("Location: login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_id = $_POST['room_id'];
    $room_name = $_POST['room_name'];
    $capacity = $_POST['capacity'];
    $size_sqm = $_POST['size_sqm'];
    $annual_price = $_POST['annual_price'];
    $room_quantity = $_POST['room_quantity'];

    $sql = "UPDATE dorm_rooms SET room_name=?, capacity=?, size_sqm=?, annual_price=?, room_quantity=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiiis", $room_name, $capacity, $size_sqm, $annual_price, $room_quantity, $room_id);

    $stmt->execute();

    header("Location: dorm_owner_dashboard.php");
    exit();
}

$room_id = $_GET['id'];
$sql = "SELECT * FROM dorm_rooms WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $room_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yurt Odası Düzenleme</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Yurt Odası Düzenleme</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="room_id" value="<?php echo $row['id']; ?>">
            <div class="mb-3">
                <label for="room_name" class="form-label">Oda Adı</label>
                <input type="text" class="form-control" id="room_name" name="room_name" value="<?php echo $row['room_name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="capacity" class="form-label">Kişi Kapasitesi</label>
                <input type="number" class="form-control" id="capacity" name="capacity" value="<?php echo $row['capacity']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="size_sqm" class="form-label">Metrekare</label>
                <input type="number" class="form-control" id="size_sqm" name="size_sqm" value="<?php echo $row['size_sqm']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="annual_price" class="form-label">Yıllık Fiyat</label>
                <input type="number" class="form-control" id="annual_price" name="annual_price" value="<?php echo $row['annual_price']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="room_quantity" class="form-label">Mevcut Oda Sayısı</label>
                <input type="number" class="form-control" id="room_quantity" name="room_quantity" value="<?php echo $row['room_quantity']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Kaydet</button>
        </form>
    </div>
</body>
</html>
