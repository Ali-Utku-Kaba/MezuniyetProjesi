<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
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


$dorm_owner_id = $_SESSION['user_id'];

$sql = "SELECT messages.id, messages.type, messages.message, messages.created_at, students.username 
        FROM messages 
        JOIN students ON messages.user_id = students.id 
        WHERE messages.dorm_id = ? 
        ORDER BY messages.created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $dorm_owner_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gelen Mesajlar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color:#f3f3f3;">
<?php include 'header.php'; ?>
</div>
<div class="container mt-5 pt-5">
        <h2 class="text-center mb-4">Gelen Mesajlar</h2>
        <?php if ($result->num_rows > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><?php echo $lang['Sender']; ?></th>
                        <th><?php echo $lang['Type']; ?></th>
                        <th><?php echo $lang['Message']; ?></th>
                        <th><?php echo $lang['Date']; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                            <td><?php echo htmlspecialchars($row['type']); ?></td>
                            <td><?php echo htmlspecialchars($row['message']); ?></td>
                            <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-center"><?php echo $lang['Message Not Found']; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
