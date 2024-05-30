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
    <title>Student Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color:#608cff;">
<div class="container mt-5">
    <div class="row">
    <div class="col-8 offset-2">
    <div class="card shadow p-4" >
    <h2><?php echo $lang['Student Registration']; ?></h2>
    <form action="register_student_process.php" method="POST">
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
            <label for="password" class="form-label"><?php echo $lang['Password']; ?></label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="gender" class="form-label"><?php echo $lang['Gender']; ?></label>
            <select class="form-select" id="gender" name="gender" required>
                <option value="Male"><?php echo $lang['Male']; ?></option>
                <option value="Female"><?php echo $lang['Female']; ?></option>
            </select>
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
            <label for="birthDate" class="form-label"><?php echo $lang['Birth Date']; ?></label>
            <input type="date" class="form-control" id="birthDate" name="birthDate" required>
        </div>
        <div class="mb-3">
            <label for="department" class="form-label"><?php echo $lang['Department']; ?></label>
            <input type="text" class="form-control" id="department" name="department" required>
        </div>
        <button type="submit" class="btn btn-primary"><?php echo $lang['Register']; ?></button>
    </form>
    </div>
    </div>
    </div>


  

</div>
</body>
</html>
