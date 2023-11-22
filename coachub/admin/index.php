<?php
include '../db_connection.php';
include 'get_order.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #e0f7ec; /* Light green background */
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #c3f0cb; /* Lighter green container */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            margin: 10px;
        }

        h2 {
            text-align: center;
            color: #006400; /* Dark green header text */
        }

        p {
            color: #333;
        }

        .actions a {
            color: #006400; /* Dark green links */
        }

        .actions a:hover {
            text-decoration: underline;
        }
    </style>
    <title>Healthcare Orders</title>
</head>
<body>
    <div class="admin-container">
        <?php
        foreach ($orders as $order) {
            echo "<div class='container'>";
            echo "<h2>Order #{$order['order_id']}</h2>";
            echo "<p><strong>User ID:</strong> {$order['user_id']}</p>";
            echo "<p><strong>Order Date:</strong> {$order['order_date']}</p>";
            echo "<p><strong>Total Price:</strong> {$order['total_price']}</p>";
            echo "<p><strong>Status:</strong> {$order['status']}</p>";
            echo "<p><strong>Delivery Address:</strong> {$order['delivery_address']}</p>";
            echo "<p><strong>Phone Number:</strong> {$order['phone_number']}</p>";
            echo "<p class='actions'>";
            echo "<a href='update_order.php?order_id={$order['order_id']}'>Update</a> | ";
            echo "<a href='delete_order.php?order_id={$order['order_id']}'>Delete</a>";
            echo "</p>";
            echo "</div>";
        }
        ?>
    </div>
    <script src="script.js"></script>
</body>
</html>
