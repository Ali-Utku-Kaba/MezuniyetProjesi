<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.html");
    exit();
}

$userId = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reset_preferences'])) {
    $sql_reset = "UPDATE Students SET roomMatePreferences = NULL WHERE id = ?";
    $stmt_reset = $conn->prepare($sql_reset);
    $stmt_reset->bind_param("i", $userId);
    $stmt_reset->execute();
    header("Location: find_roommate.php");
    exit();
}


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

$sql = "SELECT roomMatePreferences FROM Students WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$userPreferences = $result->fetch_assoc()['roomMatePreferences'];
$userPreferencesArray = json_decode($userPreferences, true);

$sql = "SELECT id, name, surname, email, phone, roomMatePreferences FROM Students WHERE id != ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

$users = [];
while ($row = $result->fetch_assoc()) {
    $row['roomMatePreferences'] = json_decode($row['roomMatePreferences'], true);
    $users[] = $row;
}

function calculateCompatibility($user1Prefs, $user2Prefs) {
    $totalQuestions = count($user1Prefs);
    $compatibilityScore = 0;

    foreach ($user1Prefs as $key => $value) {
        if (isset($user2Prefs[$key]) && $user2Prefs[$key] == $value) {
            $compatibilityScore++;
        }
    }

    return round(($compatibilityScore / $totalQuestions) * 100, 2);
}

usort($users, function($a, $b) use ($userPreferencesArray) {
    return calculateCompatibility($userPreferencesArray, $b['roomMatePreferences']) <=> calculateCompatibility($userPreferencesArray, $a['roomMatePreferences']);
});

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roommate Match</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body style="background-color:#f3f3f3;">
<div>
<?php include 'header.php'; ?>
</div>
    <div class="container mt-5 pt-5">
    <h1 class="mb-4"><?php echo $lang['Roommate Match']; ?></h1>
a

    <div class="row">
        <?php foreach ($users as $user): ?>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $user['name'] . ' ' . $user['surname']; ?></h5>
                        <p class="card-text"><?php echo $lang['Compatibility']; ?>: <?php echo calculateCompatibility($userPreferencesArray, $user['roomMatePreferences']); ?>%</p>
                        <?php
                        $checkRequestSql = "SELECT * FROM contact_requests WHERE requester_id = ? AND requested_id = ? AND status = 'approved'";
                        $checkRequestStmt = $conn->prepare($checkRequestSql);
                        $checkRequestStmt->bind_param("ii", $userId, $user['id']);
                        $checkRequestStmt->execute();
                        $checkRequestResult = $checkRequestStmt->get_result();

                        if ($checkRequestResult->num_rows > 0): ?>
                            <p class="card-text"><?php echo $lang['Email']; ?>: <?php echo $user['email']; ?></p>
                            <p class="card-text"><?php echo $lang['Phone']; ?>: <?php echo $user['phone']; ?></p>
                        <?php else: ?>
                            <form method="POST" action="request_contact.php">
                                <input type="hidden" name="requested_id" value="<?php echo $user['id']; ?>">
                                <button type="submit" class="btn btn-primary"><?php echo $lang['Request Contact Information']; ?></button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <form method="post">
        <button type="submit" class="btn btn-danger mb-3" name="reset_preferences"><?php echo $lang['Reset My Preferences']; ?></button>
    </form>
    </div>

</div>
</body>
</html>
