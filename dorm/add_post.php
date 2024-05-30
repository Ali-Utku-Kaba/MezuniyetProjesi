<?php
session_start();
include 'config.php';
if (isset($_POST['submit'])) {
    $userId = $_SESSION['user_id'];
    $content = $_POST['content'];
    $isAnonymous = isset($_POST['anonymous']) ? 1 : 0;
    $sql = "SELECT name, surname FROM Students WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $userName = $row['name'];
    $userSurname = $row['surname'];
    $sql = "INSERT INTO Wall_Posts (user_id, user_name, user_surname, content, is_anonymous) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssi", $userId, $userName, $userSurname, $content, $isAnonymous);
    $stmt->execute();
    header("Location: wall.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color:#f3f3f3;">
    <div>
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
        <h2 class="mb-3"><?php echo $lang['Add Post']; ?></h2>
        <form action="add_post.php" method="POST">
            <div class="mb-3">
                <textarea class="form-control" name="content" placeholder="<?php echo $lang['Write something...']; ?>"
                    required></textarea>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="anonymous" id="anonymous">
                <label class="form-check-label" for="anonymous"><?php echo $lang['Post Anonymously']; ?></label>
            </div>
            <button type="submit" name="submit" class="btn btn-primary"><?php echo $lang['Add Post']; ?></button>
        </form>
    </div>
</body>

</html>