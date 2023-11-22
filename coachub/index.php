<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Coachub Delivery Submission</title>
</head>
<body>

    <div class="container">
        <h2>Delivery Submission</h2>
        <form id="deliveryForm" action="insert_order.php" method="post">
            <label for="orderNumber">Order Number:</label>
            <input type="text" id="orderNumber" name="orderNumber" readonly>

            <label for="deliveryAddress">Delivery Address:</label>
            <textarea id="deliveryAddress" name="deliveryAddress" rows="4" required></textarea>

            <label for="phoneNumber">Phone Number:</label>
            <input type="tel" id="phoneNumber" name="phoneNumber" placeholder="+216 90-493-037" required>

            <label for="deliveryDate">Preferred Delivery Date:</label>
            <input type="date" id="deliveryDate" name="deliveryDate" required>

            <label for="deliveryTime">Estimated Delivery Time:</label>
            <input type="text" id="deliveryTime" name="deliveryTime" readonly>

            <input type="submit" value="Submit Delivery">
        </form>
    </div>

    <script src="script.js"></script>
</body>
</html>
