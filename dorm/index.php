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
            border-radius: 30px;
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

<div class="bg d-flex align-items-center justify-content-center">
    <div class="container text-center ">


        <?php include 'language_dropdown.php'; ?>
        <h1 class="display-4"><?php echo $lang['Welcome to the dormitory system']; ?></h1>
        <p class="lead"><?php echo $lang['This system will help you find the most suitable dorm room for you, place the most suitable roommate in the dorm room you find, and share your dormitory-related experiences.']; ?></p>
        <hr class="my-4">
        <a class="btn btn-primary btn-lg m-2" href="register_student.php" role="button"><?php echo $lang['Register as a Student']; ?></a>
        <a class="btn btn-primary btn-lg m-2" href="register_dorm_owner.php" role="button"><?php echo $lang['Register as a Dorm Owner']; ?></a>
        <a class="btn btn-primary btn-lg m-2" href="login.php" role="button"><?php echo $lang['Login']; ?></a>
    </div>
</div>

</body>
</html>
