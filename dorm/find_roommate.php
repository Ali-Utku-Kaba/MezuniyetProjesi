<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.html");
    exit();
}
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

$userId = $_SESSION['user_id'];
$sql = "SELECT roomMatePreferences FROM Students WHERE id = $userId"; 
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $roomMatePreferences = $row["roomMatePreferences"];
    if (empty($roomMatePreferences)) {

        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Roommate Preference Survey</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        </head>
        <body>
        <div>
<?php include 'header.php'; ?>
</div>
    <div class="container mt-5 pt-5">
                <h2 class="mb-4"><?php echo $lang['Roommate Preference Survey']; ?></h2>
                <form action="submit_survey.php" method="post">
                    <div class="mb-3">
                        <label for="q1" class="form-label">1. <?php echo $lang['Can you share a room with a pet?']; ?></label>
                        <select class="form-select" name="q1" required>
                            <option value="yes"><?php echo $lang['Yes']; ?></option>
                            <option value="no"><?php echo $lang['No']; ?></option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="q2" class="form-label">2. <?php echo $lang['Would you mind having a guest brought into the room?']; ?></label>
                        <select class="form-select" name="q2" required>
                            <option value="yes"><?php echo $lang['Yes']; ?></option>
                            <option value="no"><?php echo $lang['No']; ?></option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="q3" class="form-label">3. <?php echo $lang['Would you mind if food was consumed in the room?']; ?></label>
                        <select class="form-select" name="q3" required>
                            <option value="yes"><?php echo $lang['Yes']; ?></option>
                            <option value="no"><?php echo $lang['No']; ?></option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="q4" class="form-label">4. <?php echo $lang['Would you mind if alcohol was consumed in the room?']; ?></label>
                        <select class="form-select" name="q4" required>
                            <option value="yes"><?php echo $lang['Yes']; ?></option>
                            <option value="no"><?php echo $lang['No']; ?></option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="q5" class="form-label">5. <?php echo $lang['Would you mind if cigarettes were consumed in the room?']; ?></label>
                        <select class="form-select" name="q5" required>
                            <option value="yes"><?php echo $lang['Yes']; ?></option>
                            <option value="no"><?php echo $lang['No']; ?></option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary"><?php echo $lang['Submit']; ?></button>
                </form>
            </div>
        </body>
        </html>
        <?php
    } else {
        header("Location: roommate_match.php");
    }
} else {
}
$conn->close();
?>
