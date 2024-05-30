<?php session_start(); 
// Dil ayarlarını kontrol et
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
        body, html {
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
            background-color: rgba(0, 0, 0, 0.5); /* Black w/opacity */
            color: #ffffff;
            border-radius: 30px;
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
    <?php include 'language_dropdown.php';  ?>
    <h2><?php echo $lang['Student Portal']; ?></h2>
    <div class="row">
    <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $lang['School Wall']; ?></h5>
                    <p class="card-text"><?php echo $lang['On this page, you can view the anonymous and anonymous shares of users.']; ?></p>
                    <a href="wall.php" class="btn btn-primary"><?php echo $lang['School Wall']; ?></a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $lang['Contact Information Requests']; ?></h5>
                    <p class="card-text"><?php echo $lang['From this page, you can view requests for your contact information from people who have matched with you.']; ?></p>
                    <a href="approve_contact_request.php" class="btn btn-primary"><?php echo $lang['Show Contact Information Requests']; ?></a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $lang['Find the Suitable Dormitory for You']; ?></h5>
                    <p class="card-text"><?php echo $lang['On this page, you can take a look at the detailed features of the dormitories to find the suitable dormitory for you.']; ?></p>
                    <a href="find_dorm_room.php" class="btn btn-primary"><?php echo $lang['Find Dorm']; ?></a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $lang['Find the Suitable Roommate for You']; ?></h5>
                    <p class="card-text"><?php echo $lang['You can make your preferences on this screen and contact people who are highly compatible with you in line with your preferences.']; ?></p>
                    <a href="find_roommate.php" class="btn btn-primary"><?php echo $lang['Find Roommate']; ?></a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

</body>
</html>
