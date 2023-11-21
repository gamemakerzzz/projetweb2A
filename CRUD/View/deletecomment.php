<?php
include '../Controller/forumcont.php'; 
$forumController = new ForumController();

// Check if the comment ID is provided
if (isset($_GET['id']) && isset($_GET['postId'])) {
    $commentId = $_GET['id'];
    $postId = $_GET['postId'];
    
    // Call the deleteComment method
    $forumController->deleteComment($commentId);
    
    // Redirect back to the post details page or wherever appropriate
    header('Location: listpost.php?postId=' . $postId);
    exit();
} else {
    // If the comment ID is not provided, handle the error
    echo "Comment ID not provided.";
}
?>
