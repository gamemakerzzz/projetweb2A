<?php
include '../Controller/forumcont.php';


$forumController = new ForumController();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and add post
    if (
        isset($_POST["postTitle"]) &&
        isset($_POST["postAuthor"]) &&
        isset($_POST["postContent"])
    ) {
        $postTitle = $_POST["postTitle"];
        $postAuthor = $_POST["postAuthor"];
        $postContent = $_POST["postContent"];

        if (!empty($postTitle) && !empty($postAuthor) && !empty($postContent)) {
            $post = new Post(null, $postTitle, $postAuthor, $postContent);
            $forumController->addPost($post);
        }
    }

    // Validate and add comment
    if (
        isset($_POST["commentAuthor"]) &&
        isset($_POST["commentContent"]) &&
        isset($_POST["postId"])
    ) {
        $commentAuthor = $_POST["commentAuthor"];
        $commentContent = $_POST["commentContent"];
        $postId = $_POST["postId"];

        if (!empty($commentAuthor) && !empty($commentContent) && !empty($postId)) {
            $comment = new Comment(null, $commentAuthor, $commentContent, $postId);
            $forumController->addComment($comment);
        }
    }
}

// Retrieve posts
$posts = $forumController->getPosts();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discussion Forum</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        function validatePostForm() {
            var postTitle = document.getElementById("postTitle").value;
            var postAuthor = document.getElementById("postAuthor").value;
            var postContent = document.getElementById("postContent").value;

            if (postTitle.trim() === "" || postAuthor.trim() === "" || postContent.trim() === "") {
                alert("All fields are required for the post.");
                return false;
            }

            return true;
        }

        function validateCommentForm(postId) {
            var commentAuthor = document.getElementById("commentAuthor" + postId).value;
            var commentContent = document.getElementById("commentContent" + postId).value;

            if (commentAuthor.trim() === "" || commentContent.trim() === "") {
                alert("All fields are required for the comment.");
                return false;
            }

            return true;
        }
    </script>
</head>

<body>
    <div class="container">
    <h1 style="text-align:center; color: #ff00b3;">The healthy forum</h1>
    <div class="search-bar">
      <input type="text" id="searchInput" placeholder="Search by title">
      <button class="button" onclick="searchPosts()">Search</button>
    </div>
        <hr>

        <div class="post-content">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" onsubmit="return validatePostForm();">
                <input type="text" id="postTitle" name="postTitle" placeholder="Post Title">
                <input type="text" id="postAuthor" name="postAuthor" placeholder="Your username">
                <textarea id="postContent" name="postContent" placeholder="Write your post here"></textarea>
                <button class="button" type="submit" value="Submit Post">Submit Post</button>
            </form>
        </div>

        <!-- Display posts -->
        <div>
            <?php
            if (!empty($posts)) {
                foreach ($posts as $post) {
                    echo "<div class='post-container'>";
                    echo "<div class='post-content'>";
                    echo "<h3>{$post->getTitle()}</h3>";
                    echo "<p>Post by {$post->getAuthor()}</p>";
                    echo "<p>{$post->getContent()}</p>";

                    // Comment form with unique id attributes
                    echo "<form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='POST' onsubmit='return validateCommentForm({$post->getId()});'>";
                    echo "<input type='hidden' name='postId' value='{$post->getId()}'>";
                    echo "<input type='text' id='commentAuthor{$post->getId()}' name='commentAuthor' placeholder='Your username'>";
                    echo "<textarea id='commentContent{$post->getId()}' name='commentContent' placeholder='Write your comment'></textarea>";
                    echo "<button class='button' type='submit' value='Submit Comment'>Submit Comment</button>";
                    echo "</form>";

                    // Display comments
                    $comments = $forumController->getCommentsByPost($post->getId());
                    if (!empty($comments)) {
                        echo "<div class='comments'>";
                        echo "<h4>Comments:</h4>";
                        foreach ($comments as $comment) {
                            echo "<div class='comment'>";
                            echo "<p>{$comment->getContent()} says: {$comment->getPostId()}</p>";
                            echo "</div>";
                        }
                        echo "</div>";
                    }

                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No posts found.</p>";
            }
            ?>
        </div>
    </div>
</body>

</html>
