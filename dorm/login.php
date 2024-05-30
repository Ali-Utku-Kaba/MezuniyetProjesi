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
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>


<body style="background-color:#608cff;">
    <div class="container mt-5">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="card shadow p-4">
                    <h2><?php echo $lang['Login']; ?></h2>
                    <form action="login_process.php" method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label"><?php echo $lang['Username']; ?></label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label"><?php echo $lang['Password']; ?></label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label"><?php echo $lang['Role']; ?></label>
                            <select class="form-select" id="role" name="role" required>
                                <option value="student"><?php echo $lang['Student']; ?></option>
                                <option value="dorm_owner"><?php echo $lang['Dorm Owner']; ?></option>
                                <option value="admin"><?php echo $lang['Admin']; ?></option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary"><?php echo $lang['Login']; ?></button>
                    </form>
                    <p class="mt-3"><?php echo $lang['Dont have an account?']; ?></p>
                    <a class="btn btn-secondary" href="register_student.php"
                        role="button"><?php echo $lang['Register as a Student']; ?></a>
                    <a class="btn btn-secondary mt-2" href="register_dorm_owner.php"
                        role="button"><?php echo $lang['Register as a Dorm Owner']; ?></a>
                </div>
            </div>
        </div>




    </div>
</body>

</html>