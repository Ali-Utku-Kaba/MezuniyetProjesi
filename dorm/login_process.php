<?php
session_start();
include 'config.php';

$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];

if ($role === 'admin') {
    $sql = "SELECT * FROM admins WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        if (password_verify($password, $admin['password'])) {
            $_SESSION['user_id'] = $admin['id'];
            $_SESSION['username'] = $admin['username'];
            $_SESSION['role'] = 'admin';
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "Hatalı bilgi girişi yaptınız.";
            header("Refresh: 3; url=login.html"); 
        }
    } else {
        echo "Hatalı bilgi girişi yaptınız.";
        header("Refresh: 3; url=login.html"); 
    }
} else {
    if ($role === 'student') {
        $sql = "SELECT * FROM students WHERE username = ?";
    }  if ($role === 'dorm_owner') {
        $sql = "SELECT * FROM dorm_owners WHERE username = ?";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            if ($user['is_approved'] == 1) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $role;
                header("Location: dashboard.php");
                exit();
            } else {
                echo "Hesabınız henüz onaylanmadı.";
                header("Refresh: 3; url=login.html"); 
            }
        } else {
            echo "Hatalı bilgi girişi yaptınız.";
            header("Refresh: 3; url=login.html"); 
        }
    } else {
        echo "Hatalı bilgi girişi yaptınız.";
        header("Refresh: 3; url=login.html"); 
    }
}

$conn->close();
?>
