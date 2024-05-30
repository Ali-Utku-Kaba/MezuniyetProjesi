<?php
session_start();


include 'config.php';
if (isset($_GET['dorm_id'])) {
    $dorm_id = $_GET['dorm_id'];

    $sql = "SELECT * FROM dorm_rooms WHERE dorm_owner_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $dorm_id);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    echo "Yurt ID belirtilmedi.";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yurt Odalarını Görüntüle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body style="background-color:#f3f3f3;f">
<div>
<?php include 'header.php'; ?>
<?php 
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
} else {
    if (!isset($_SESSION['lang'])) {
        $_SESSION['lang'] = 'en'; 
    }
}
if ($_SESSION['lang'] == 'tr') {
    include 'lang_tr.php';
} else {
    include 'lang_en.php';
}
 ?>
</div>

    <div class="container mt-5 pt-5">
        <h2 class="text-center mb-4"><?php echo $lang['Rooms']; ?></h2>
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                        <img src="<?php echo $row['image_path']; ?>" class="card-img-top" alt="Oda Resmi">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['room_name']; ?></h5>
                                <p class="card-text"><?php echo $lang['Capacity']; ?>: <?php echo $row['capacity']; ?> <?php echo $lang['Features']; ?></p>
                                <p class="card-text"><?php echo $lang['Size']; ?>: <?php echo $row['size_sqm']; ?> m²</p>
                                <p class="card-text"><?php echo $lang['Price']; ?>: <?php echo $row['annual_price']; ?> TL/Yıl</p>
                                <p class="card-text"><?php echo $lang['Available Room Quantity']; ?>: <?php echo $row['room_quantity']; ?></p>
                                <p class="card-text"><?php echo $lang['Features']; ?>: <?php echo $row['features']; ?></p>
                                <form method="POST" action="submit_reservation.php">
    <input type="hidden" name="room_id" value="<?php echo $row['id']; ?>">
    <hr>
    <p><?php echo $lang['If you want to visit this room and see it live, we can create a reservation request, contact you via your contact information and show you the room on a convenient date.']; ?></p>

    <button type="submit" class="btn btn-primary"><?php echo $lang['Send a Reservation Request']; ?></button>
</form>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "Bu yurda odalar bulunamadı.";
            }
            $conn->close();
            ?>
        </div>
    </div>
</body>

</html>