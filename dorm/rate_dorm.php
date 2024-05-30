<?php
include 'config.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    echo "Lütfen giriş yapın.";
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dorm_id = $_POST['dorm_id'];
    $rating = $_POST['rating'];

    $sql = "SELECT * FROM dorm_ratings WHERE user_id = ? AND dorm_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $dorm_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Bu yurdu daha önce puanladınız.";
        $stmt->close();
        $conn->close();
        exit();
    }
    $stmt->close();

    $sql = "INSERT INTO dorm_ratings (user_id, dorm_id, rating) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $user_id, $dorm_id, $rating);
    $stmt->execute();
    $stmt->close();

    $sql = "SELECT dormRating, ratingCount FROM dorm_owners WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $dorm_id);
    $stmt->execute();
    $stmt->bind_result($currentRating, $ratingCount);
    $stmt->fetch();
    $stmt->close();

    $newRatingCount = $ratingCount + 1;
    $newRating = (($currentRating * $ratingCount) + $rating) / $newRatingCount;

    $sql = "UPDATE dorm_owners SET dormRating = ?, ratingCount = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("dii", $newRating, $newRatingCount, $dorm_id);

    if ($stmt->execute()) {
        header("Location: find_dorm_room.php");

    } else {
        echo "Hata: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
