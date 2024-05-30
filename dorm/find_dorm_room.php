<?php
            session_start();
            include 'config.php';


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
    <title>Yurt Odalarını Bul</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color:#f3f3f3;">
<div>
<?php include 'header.php'; ?>
</div>
    <div class="container mt-5 pt-5">
        <h2 class="text-center mb-4"><?php echo $lang['Dorms']; ?></h2>
        <div class="row">
            <?php

            $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

            $sql = "SELECT id, dormName, dormContactNumber, dormEmail, dormWebsite, dormAddress, dormFeatures, dormImage, dormRating, ratingCount FROM dorm_owners";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $dorm_id = $row['id'];

                    $ratingGiven = false;
                    if ($user_id) {
                        $sql2 = "SELECT * FROM dorm_ratings WHERE user_id = ? AND dorm_id = ?";
                        $stmt = $conn->prepare($sql2);
                        $stmt->bind_param("ii", $user_id, $dorm_id);
                        $stmt->execute();
                        $stmt->store_result();
                        $ratingGiven = $stmt->num_rows > 0;
                        $stmt->close();
                    }
                    ?>
                    <div class="col-md-4 mb-4">
                        <div class="card" >
                            <?php if (!empty($row['dormImage'])) { ?>
                                <img height="275" width="400" src="<?php echo $row['dormImage']; ?>" class="card-img-top" alt="Yurt Resmi">
                            <?php } ?>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['dormName']; ?></h5>
                                <p class="card-text"><strong><?php echo $lang['Dorm Contact Number']; ?></strong> <?php echo $row['dormContactNumber']; ?></p>
                                <p class="card-text"><strong><?php echo $lang['Dorm Contact Email']; ?></strong> <?php echo $row['dormEmail']; ?></p>
                                <p class="card-text"><strong><?php echo $lang['Dorm Website']; ?></strong> <a href="<?php echo $row['dormWebsite']; ?>" target="_blank"><?php echo $row['dormWebsite']; ?></a></p>
                                <p class="card-text"><strong><?php echo $lang['Dorm Address']; ?></strong> <?php echo $row['dormAddress']; ?></p>
                                <p class="card-text"><strong><?php echo $lang['Features']; ?></strong> <?php echo $row['dormFeatures']; ?></p>
                                <p class="card-text"><strong><?php echo $lang['Rate']; ?></strong> <?php echo $row['dormRating']; ?> / 5 (<?php echo $row['ratingCount']; ?>  <?php echo $lang['Vote']; ?>)</p>
                                 <?php if (!$ratingGiven) { ?>
                                    <form action="rate_dorm.php" method="post" class="mt-2">
                                        <input type="hidden" name="dorm_id" value="<?php echo $row['id']; ?>">
                                        <div class="input-group">
                                            <input type="number" name="rating" min="1" max="5" class="form-control" placeholder="Yurdu Puanla (1-5)" required>
                                            <button type="submit" class="btn btn-success"><?php echo $lang['Vote']; ?></button>
                                        </div>
                                    </form>
                                <?php } else { ?>
                                    <p class="text-success mt-2"><?php echo $lang['You have rated this dormitory before.']; ?></p>
                                <?php } ?>
                                <a href="view_rooms.php?dorm_id=<?php echo $row['id']; ?>" class="btn btn-primary"><?php echo $lang['Show Rooms']; ?></a>
                                <a href="form_page.php?dorm_id=<?php echo $row['id']; ?>" class="btn btn-warning mt-2"><?php echo $lang['Send Message']; ?></a>

                               
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p class='text-center'>Yurt bulunamadı.</p>";
            }
            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
