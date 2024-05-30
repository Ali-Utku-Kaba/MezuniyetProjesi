<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.html");
    exit();
}

$q1 = $_POST["q1"];
$q2 = $_POST["q2"];
$q3 = $_POST["q3"];
$q4 = $_POST["q4"];
$q5 = $_POST["q5"];

$surveyAnswers = array($q1,$q2, $q3, $q4, $q5);

include 'config.php';

$userId = $_SESSION['user_id'];

$sql = "UPDATE Students SET roomMatePreferences = '" . json_encode($surveyAnswers) . "' WHERE id = $userId"; 
if ($conn->query($sql) === TRUE) {
    echo "Seçimlerin güncellendi, uyumlu olduğun kişiler ile listeye yönlendiriliyorsun!";
    header("Refresh: 3; url=roommate_match.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>