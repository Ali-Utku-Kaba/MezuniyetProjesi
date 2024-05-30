<?php
session_start();
include 'config.php';



$sql = "SELECT * FROM Wall_Posts ORDER BY posted_at DESC";
$result = $conn->query($sql);

function fetchComments($postId, $conn) {
    $sql = "SELECT * FROM Wall_Comments WHERE post_id = ? ORDER BY commented_at DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $postId);
    $stmt->execute();
    return $stmt->get_result();
}

$isAdmin = $_SESSION['role'] === 'admin';
?>

<?php 
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
    <title>Wall</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color:#f4f4f4;">
<div>
<?php include 'header.php'; 


?>
</div>

    <div class="container mt-5 pt-5">

        <div class="row">
            <div class="col-md-12 text-end">
                <a href="add_post.php" class="btn btn-primary"><?php echo $lang['Add Post']; ?></a>
            </div>
        </div>
        <div class="row mt-3">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $postId = $row['post_id'];
                    $content = $row['content'];
                    $userName = $row['user_name'];
                    $userSurname = $row['user_surname'];
                    $isAnonymous = $row['is_anonymous'] ? "Anonymous" : "$userName $userSurname";
                    $postedAt = date("d M Y, H:i", strtotime($row['posted_at']));

                    $comments = fetchComments($postId, $conn);
            ?>
                    <div class="col-md-6">
                        <div class="card mb-3 shadow">
                            <div class="card-body">
                                <p class="card-text"><?php echo $isAnonymous; ?></p>
                                <p class="card-text"><?php echo $content; ?></p>

                                <p class="card-text"><?php echo $postedAt; ?></p>
                                <?php if ($isAdmin) { ?>
                                    <form action="delete_post.php" method="POST" class="d-inline">
                                        <input type="hidden" name="post_id" value="<?php echo $postId; ?>">
                                        <button type="submit" class="btn btn-danger btn-sm"><?php echo $lang['Delete Post']; ?></button>
                                    </form>
                                <?php } ?>
                                
                                <div class="mt-4">
                                    <h6><?php echo $lang['Comments']; ?>:</h6>
                                    <?php
                                    if ($comments->num_rows > 0) {
                                        while ($commentRow = $comments->fetch_assoc()) {
                                            $commentId = $commentRow['id'];
                                            $commentContent = $commentRow['comment'];
                                            $commentUserName = $commentRow['user_name'];
                                            $commentUserSurname = $commentRow['user_surname'];
                                            $commentIsAnonymous = $commentRow['is_anonymous'] ? "Anonymous" : "$commentUserName $commentUserSurname";
                                            $commentedAt = date("d M Y, H:i", strtotime($commentRow['commented_at']));
                                    ?>
                                            <div class="border rounded p-2 mb-2">
                                                <p class="mb-1"><?php echo $commentContent; ?></p>
                                                <small class="text-muted"><?php echo $commentIsAnonymous; ?> - <?php echo $commentedAt; ?></small>
                                                <?php if ($isAdmin) { ?>
                                                    <form action="delete_comment.php" method="POST" class="d-inline">
                                                        <input type="hidden" name="comment_id" value="<?php echo $commentId; ?>">
                                                        <button type="submit" class="btn btn-danger btn-sm"><?php echo $lang['Delete Comment']; ?></button>
                                                    </form>
                                                <?php } ?>
                                            </div>
                                    <?php
                                        }
                                    } else {
                                        echo "<p>No comments yet.</p>";
                                    }
                                    ?>
                                </div>

                                <form action="add_comment.php" method="POST" class="mt-3">
                                    <input type="hidden" name="post_id" value="<?php echo $postId; ?>">
                                    <div class="mb-3">
                                        <textarea class="form-control" name="comment" placeholder="<?php echo $lang['Add a comment']; ?>" required></textarea>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="anonymous_<?php echo $postId; ?>" name="anonymous">
                                        <label class="form-check-label" for="anonymous_<?php echo $postId; ?>"><?php echo $lang['Post Anonymously']; ?></label>
                                    </div>
                                    <button type="submit" class="btn btn-secondary"><?php echo $lang['Comment']; ?></button>
                                </form>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<div class='col-md-12'><p>No posts found.</p></div>";
            }
            ?>
        </div>
    </div>
</body>
</html>
