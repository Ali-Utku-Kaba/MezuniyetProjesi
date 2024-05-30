
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // Eğer kullanıcı giriş yapmamışsa, giriş sayfasına yönlendirin
    header("Location: login.php");
    exit();
}

$dorm_id = $_GET['dorm_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mesaj Gönder</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color:#f3f3f3;">
<?php include 'header.php'; ?>
</div>
    <div class="container mt-5 pt-5">
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
        <h2 class="text-center mb-4"><?php echo $lang['Send Message']; ?></h2>
        <form action="send_message.php" method="post">
            <input type="hidden" name="dorm_id" value="<?php echo $dorm_id; ?>">
            <div class="mb-3">
                <label for="messageType" class="form-label"><?php echo $lang['Message Type']; ?></label>
                <select class="form-select" id="messageType" name="type" required>
                    <option value="istek"><?php echo $lang['Request']; ?></option>
                    <option value="sikayet"><?php echo $lang['Suggestion']; ?></option>
                    <option value="oneri"><?php echo $lang['Report']; ?></option>
                </select>
            </div>
            <div class="mb-3">
                <label for="messageContent" class="form-label"><?php echo $lang['Message']; ?></label>
                <textarea class="form-control" id="messageContent" name="message" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary"><?php echo $lang['Send']; ?></button>
        </form>
    </div>
</body>
</html>
