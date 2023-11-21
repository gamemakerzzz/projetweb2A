<?php

include '../Controller/forumcont.php';
$forumController = new ForumController();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST["commentId"]) &&
        isset($_POST["commentContent"])
    ) {
        $commentId = $_POST["commentId"];
        $commentContent = $_POST["commentContent"];

        if (isValidContent($commentContent)) {
            $success = $forumController->updateComment($commentId, $commentContent);

            if ($success) {
                header("Location: listPosts.php"); // Redirect to wherever you want after updating
                exit();
            } else {
                echo "Failed to update comment. Please try again.";
            }
        } else {
            echo "Comment content is required.";
        }
    }
}

// Function to check if content is valid
function isValidContent($content) {
    return !empty($content) && strlen($content) >= 3;
}

// Retrieve comment details
if (isset($_GET['id'])) {
    $commentId = $_GET['id'];
    $comment = $forumController->getCommentById($commentId);

    if (!$comment) {
        echo "Comment not found.";
        exit();
    }
} else {
    echo "Comment ID not provided.";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Comment</title>
</head>

<body>
    <button><a href="listPosts.php">Back to list</a></button>
    <hr>

    <?php
    if (isset($comment)) {
    ?>

        <form action="" method="POST">
            <input type="hidden" name="commentId" value="<?php echo $comment->getId(); ?>">
            <label for="commentContent">Comment:</label>
            <textarea id="commentContent" name="commentContent"><?php echo htmlspecialchars($comment->getContent()); ?></textarea><br>
            <input type="submit" value="Update Comment">
            <input type="reset" value="Reset">
        </form>

    <?php
    }
    ?>

</body>

</html>
