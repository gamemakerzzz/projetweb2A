<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Site Problem Submission</title>
</head>
<body>
    <div class="container">
        <h1>Report a Site Problem</h1>
        <p>Submit details about the issue you're experiencing, and our administrators will assist you.</p>

        <form id="problemForm" action="insert.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required title="Only letters and spaces allowed">

            <label for="contact">Email or Phone:</label>
            <input type="text" id="contact" name="contact" required title="Enter a valid email or phone number">

            <label for="problem">Describe the Problem:</label>
            <textarea id="problem" name="problem" rows="4" required></textarea>

            <button type="submit">Submit</button>
        </form>
    </div>

    <script src="script.js"></script>
</body>
</html>
