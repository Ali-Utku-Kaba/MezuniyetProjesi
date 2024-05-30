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



$pending_dorm_owners_sql = "SELECT * FROM dorm_owners WHERE is_approved = 0";
$pending_dorm_owners_result = $conn->query($pending_dorm_owners_sql);

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
    <h3><?php echo $lang['Dorm Owners Awaiting Approval']; ?></h3>
    <table class="table table-dark table-hover table-borderless table-striped">

        <thead>
            <tr>


            <th><?php echo $lang['Name']; ?> <?php echo $lang['Surname']; ?></th>
                <th><?php echo $lang['Username']; ?></th>
                <th><?php echo $lang['Dorm Name']; ?></th>
                <th><?php echo $lang['Email']; ?></th>
                <th><?php echo $lang['Phone']; ?></th>
                <th><?php echo $lang['Dorm Website']; ?></th>
                <th><?php echo $lang['Dorm Contact Number']; ?></th>
                <th><?php echo $lang['Dorm Contact Email']; ?></th>
                <th><?php echo $lang['Dorm Address']; ?></th>
                <th><?php echo $lang['Features']; ?></th>
                <th><?php echo $lang['Action']; ?></th>



            </tr>
        </thead>
        <tbody>
            <?php while($owner = $pending_dorm_owners_result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $owner['name'] . " " . $owner['surname']; ?></td>
                <td><?php echo $owner['username']; ?></td>
                <td><?php echo $owner['dormName']; ?></td>
                <td><?php echo $owner['email']; ?></td>
                <td><?php echo $owner['phone']; ?></td>
                <td><?php echo $owner['dormWebsite']; ?></td>
                <td><?php echo $owner['dormContactNumber']; ?></td>
                <td><?php echo $owner['dormEmail']; ?></td>
                <td><?php echo $owner['dormAddress']; ?></td>
                <td><?php echo $owner['dormFeatures']; ?></td>
                <td>
                    <a href="approve.php?type=dorm_owner&id=<?php echo $owner['id']; ?>" class="btn btn-success">Onayla</a>
                    <a href="reject.php?type=dorm_owner&id=<?php echo $owner['id']; ?>" class="btn btn-danger">Reddet</a>
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
