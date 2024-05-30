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
    <title>Yurt Sahibi Kayıt Formu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>






<body style="background-color:#608cff;">
<div class="container mt-5">
    <div class="row">
    <div class="col-8 offset-2">
    <div class="card shadow p-4" >
    <h2><?php echo $lang['Dorm Owner Registration']; ?></h2>
    <form method="POST" action="register_dorm_owner_process.php" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label"><?php echo $lang['Name']; ?></label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="surname" class="form-label"><?php echo $lang['Surname']; ?></label>
                <input type="text" class="form-control" id="surname" name="surname" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label"><?php echo $lang['Username']; ?></label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="dormName" class="form-label"><?php echo $lang['Dorm Name']; ?></label>
                <input type="text" class="form-control" id="dormName" name="dormName" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label"><?php echo $lang['Password']; ?></label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label"><?php echo $lang['Email']; ?></label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label"><?php echo $lang['Phone']; ?></label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="mb-3">
                <label for="dormWebsite" class="form-label"><?php echo $lang['Dorm Website']; ?></label>
                <input type="url" class="form-control" id="dormWebsite" name="dormWebsite">
            </div>
            <div class="mb-3">
                <label for="dormContactNumber" class="form-label"><?php echo $lang['Dorm Contact Number']; ?></label>
                <input type="text" class="form-control" id="dormContactNumber" name="dormContactNumber">
            </div>
            <div class="mb-3">
                <label for="dormEmail" class="form-label"><?php echo $lang['Dorm Contact Email']; ?></label>
                <input type="email" class="form-control" id="dormEmail" name="dormEmail">
            </div>
            <div class="mb-3">
                <label for="dormAddress" class="form-label"><?php echo $lang['Dorm Address']; ?></label>
                <textarea class="form-control" id="dormAddress" name="dormAddress" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label"><?php echo $lang['Features']; ?></label>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Kafe" id="kafe" name="dormFeatures[]">
                            <label class="form-check-label" for="kafe"><?php echo $lang['Cafe']; ?></label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Güvenlik" id="guvenlik" name="dormFeatures[]">
                            <label class="form-check-label" for="guvenlik"><?php echo $lang['Security']; ?></label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Resturant" id="resturant" name="dormFeatures[]">
                            <label class="form-check-label" for="resturant"><?php echo $lang['Resturant']; ?></label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Market" id="market" name="dormFeatures[]">
                            <label class="form-check-label" for="market"><?php echo $lang['Market']; ?></label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Kırtasiye" id="kirtasiye" name="dormFeatures[]">
                            <label class="form-check-label" for="kirtasiye"><?php echo $lang['Stationary']; ?></label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Gym" id="gym" name="dormFeatures[]">
                            <label class="form-check-label" for="gym"><?php echo $lang['Gym']; ?></label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Sinema" id="sinema" name="dormFeatures[]">
                            <label class="form-check-label" for="sinema"><?php echo $lang['Cinema']; ?></label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Çamaşırhane" id="camasirhane" name="dormFeatures[]">
                            <label class="form-check-label" for="camasirhane"><?php echo $lang['Laundry']; ?></label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Ortak Mutfak" id="ortakMutfak" name="dormFeatures[]">
                            <label class="form-check-label" for="ortakMutfak"><?php echo $lang['Share Kitchen']; ?></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label"><?php echo $lang['Dorm Image']; ?></label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
                    <button type="submit" class="btn btn-primary"><?php echo $lang['Register']; ?></button>
        </form>
    </div>
    </div>
    </div>


  

</div>
</body>





</html>