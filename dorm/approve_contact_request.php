<?php
session_start();
include 'config.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.html");
    exit();
}
$userId = $_SESSION['user_id'];
$sql = "SELECT cr.id, s.name, s.surname, s.email, s.phone FROM contact_requests cr
        JOIN students s ON cr.requester_id = s.id
        WHERE cr.requested_id = ? AND cr.status = 'pending'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
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
    <title>İletişim Bilgisi Talepleri</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body style="background-color:#f3f3f3;">
    <div>
        <?php include 'header.php'; ?>
    </div>
    <div class="container mt-5 pt-5">
        <h1 class="mb-4"><?php echo $lang['Contact Information Requests']; ?></h1>
        <div class="row">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['name'] . ' ' . $row['surname']; ?></h5>
                            <p><?php echo $lang['A student named requests your contact information to contact you.']; ?></p>
                            <p><?php echo $lang['If you accept, your Email and Phone Number information will be shared with the other person.']; ?>
                            </p>
                            <form method="POST" action="process_request.php">
                                <input type="hidden" name="request_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="action" value="approve"
                                    class="btn btn-success"><?php echo $lang['Approve']; ?></button>
                                <button type="submit" name="action" value="reject"
                                    class="btn btn-danger"><?php echo $lang['Reject']; ?></button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>

</html>
<?php
$conn->close();
?>