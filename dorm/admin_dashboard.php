<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.html");
    exit();
}

include 'config.php';
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
} else {
    // Varsayılan dil ayarını belirle
    if (!isset($_SESSION['lang'])) {
        $_SESSION['lang'] = 'en'; // Varsayılan olarak İngilizce
    }
}
// Seçilen dili yükle
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
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        .bg {
            /* The image used */
            background-image: url('https://images.pexels.com/photos/271639/pexels-photo-271639.jpeg?auto=compress&cs=tinysrgb&w=1600');

            /* Full height */
            height: 100%;

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .container {
            background-color: rgba(0, 0, 0, 0.5);
            /* Black w/opacity */
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

        <div class="container mt-5 text-center" >
            <?php include 'language_dropdown.php'; 
?>
            <h2><?php echo $lang['Admin Panel']; ?></h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?php echo $lang['Students Awaiting Approval']; ?></h5>
                            <p class="card-text"></p>
                            <a href="pending_students.php" class="btn btn-primary"><?php echo $lang['Show']; ?></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?php echo $lang['Dorm Owners Awaiting Approval']; ?></h5>
                            <p class="card-text"></p>
                            <a href="pending_dorm_owners.php" class="btn btn-primary"><?php echo $lang['Show']; ?></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?php echo $lang['School Wall Posts']; ?></h5>
                            <p class="card-text"></p>
                            <a href="wall.php" class="btn btn-primary"><?php echo $lang['Show']; ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>