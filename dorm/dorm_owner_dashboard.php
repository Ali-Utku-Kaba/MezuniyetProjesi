<?php session_start(); 

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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Dorm Room Finder</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }
        .bg {
            background-image: url('https://images.pexels.com/photos/271639/pexels-photo-271639.jpeg?auto=compress&cs=tinysrgb&w=1600');
            height: 100%; 
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .container {
            background-color: rgba(0, 0, 0, 0.5); 
            color: #ffffff;
            padding: 20px;
        }

        .btn-custom {
            background-color: #ff9800;
            color: white;
        }

        .btn-custom:hover {
            background-color: #e68900;
        }
    </style>
</head>
<body>

<div class="bg d-flex align-items-center justify-content-center">

<div class="container mt-5 text-center">
<?php include 'language_dropdown.php'; ?>
    <h2>Yurt Sahibi Paneli</h2>
    <div class="row">
    <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <h5 class="card-title"><?php echo $lang['Add Dorm Room']; ?></h5>
                    <p class="card-text"></p>
                    <a href="add_room.php" class="btn btn-primary">Yurt Ekle</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
        <div class="card mb-4">
                <div class="card-body text-center">
                    <h5 class="card-title"><?php echo $lang['List Dorm Rooms']; ?></h5>
                    <p class="card-text"></p>
                    <a href="dorm_room_list.php" class="btn btn-primary"><?php echo $lang['List Dorm Rooms']; ?></a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4 text-center">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $lang['Dorm Room Reservation Request']; ?></h5>
                    <a href="view_reservation_requests.php" class="btn btn-primary"><?php echo $lang['Show Reservation Request']; ?></a>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card mb-4 text-center">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $lang['Messages']; ?></h5>
                    <a href="view_message.php" class="btn btn-primary"><?php echo $lang['Show Messages']; ?></a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

</body>
</html>
