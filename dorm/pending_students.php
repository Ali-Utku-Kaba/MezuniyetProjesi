<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.html");
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

include 'config.php';

$pending_students_sql = "SELECT * FROM students WHERE is_approved = 0";
$pending_students_result = $conn->query($pending_students_sql);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'header.php'; ?>
</div>
    <div class="container mt-5 pt-5">
    <h3><?php echo $lang['Students Awaiting Approval']; ?></h3>

    <table class="table table-dark table-hover table-borderless table-striped">
        <thead>
            <tr>
                <th><?php echo $lang['Name']; ?> <?php echo $lang['Surname']; ?></th>
                <th><?php echo $lang['Username']; ?></th>
                <th><?php echo $lang['Gender']; ?></th>
                <th><?php echo $lang['Email']; ?></th>
                <th><?php echo $lang['Phone']; ?></th>
                <th><?php echo $lang['Birth Date']; ?></th>
                <th><?php echo $lang['Department']; ?></th>
                <th><?php echo $lang['Action']; ?></th>
            </tr>
        </thead>
        <tbody>
            <?php while($student = $pending_students_result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $student['name'] . " " . $student['surname']; ?></td>
                <td><?php echo $student['username']; ?></td>
                <td><?php echo $student['gender']; ?></td>
                <td><?php echo $student['email']; ?></td>
                <td><?php echo $student['phone']; ?></td>
                <td><?php echo $student['birthDate']; ?></td>
                <td><?php echo $student['department']; ?></td>
                <td>
                    <a href="approve.php?type=student&id=<?php echo $student['id']; ?>" class="btn btn-success"><?php echo $lang['Approve']; ?></a>
                    <a href="reject.php?type=student&id=<?php echo $student['id']; ?>" class="btn btn-danger"><?php echo $lang['Reject']; ?></a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>



</div>
</body>
</html>

<?php
$conn->close();
?>
