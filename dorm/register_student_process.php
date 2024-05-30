<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $birthDate = $_POST['birthDate'];
    $department = $_POST['department'];

    $sql = "INSERT INTO students (name, surname, username, password, gender, email, phone, birthDate, department) VALUES ('$name', '$surname', '$username', '$password', '$gender', '$email', '$phone', '$birthDate', '$department')";

    if ($conn->query($sql) === TRUE) {
        echo "Kayıt başarılı. Giriş yapabilmeniz için profilinizin yönetici tarafından doğrulanması gerekmektedir.";
         header("Refresh: 3; url=login.html"); 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>
