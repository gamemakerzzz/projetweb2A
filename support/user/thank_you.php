<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Thank You for Your Submission</title>
</head>
<body>
    <div class="container">
        <h1>Thank You for Your Submission</h1>

        <?php
            include('db_connection.php');

            try {
                $sql = "SELECT submission_id, name, contact, problem_description FROM usersubmissions ORDER BY submission_date DESC LIMIT 1";
                
                // Prepare the statement
                $stmt = $conn->prepare($sql);
                
                // Execute the statement
                $stmt->execute();

                // Fetch the result
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($row) {
                    echo "<p>Name: " . $row["name"] . "</p>";
                    echo "<p>Contact: " . $row["contact"] . "</p>";
                    echo "<p>Problem Description: " . $row["problem_description"] . "</p>";

                    // Add update and delete options
                    echo '<p>Actions:
                            <a href="delete_submission.php?id=' . $row["submission_id"] . '">Delete</a>
                          </p>';
                } else {
                    echo "No submissions yet.";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            } finally {
                $conn = null;
            }
        ?>
            <form action="update_submission.php" method="post">
            <input type="hidden" name="submission_id" value="<?php echo $row['submission_id']; ?>">
            <label for="updated_name">Updated Name:</label>
            <input type="text" id="updated_name" name="updated_name" value="<?php echo $row['name']; ?>" required>

            <label for="updated_contact">Updated Email or Phone:</label>
            <input type="text" id="updated_contact" name="updated_contact" value="<?php echo $row['contact']; ?>" required>

            <label for="updated_problem">Updated Problem Description:</label>
            <textarea id="updated_problem" name="updated_problem" rows="4" required><?php echo $row['problem_description']; ?></textarea>

            <button type="submit">Update</button>
        </form>


        <p>We appreciate your feedback. Our administrators will review your submission and assist you as soon as possible.</p>
    </div>

    <script src="script.js"></script>
</body>
</html>
