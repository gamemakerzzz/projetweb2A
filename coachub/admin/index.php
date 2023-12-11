<?php
include '../db_connection.php';
include 'get_order.php';

$ordersPerPage = 2;

$searchOrderId = isset($_GET['search']) ? intval($_GET['search']) : null;
if ($searchOrderId !== null) {
    $searchResult = array_filter($orders, function ($order) use ($searchOrderId) {
        return $order['order_id'] == $searchOrderId;
    });

    if (empty($searchResult)) {
        echo "<script>alert('Order ID not found.');</script>";
        echo "<script>window.location.href = 'index.php';</script>";
        exit;
    } else {
        $orders = $searchResult;
    }
}                                                                                                                                       

$totalOrders = count($orders);

$totalPages = ceil($totalOrders / $ordersPerPage);

$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

$offset = ($page - 1) * $ordersPerPage;

$paginatedOrders = array_slice($orders, $offset, $ordersPerPage);

?>
<!DOCTYPE html>
<html lang="en">
<head>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../favicon.png">
    <link rel="stylesheet" href="../styles.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #e0f7ec; 
            margin: 0;
            display: flex;
            justify-content: center;
        }
         
        .container {
            background-color: #c3f0cb; 
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
            width: 400px;
            margin: 20px;
        }

        h2 {
            text-align: center;
            color: #006400;
        }

        p {
            color: #333;
        }

        .actions a {
            color: #006400; 
        }

        .actions a:hover {
            text-decoration: underline;
        }

        .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
        flex-direction: column;
        }

        .pagination a {
            color: #006400;
            padding: 8px 12px;
            margin: 0 4px;
            border: 1px solid #006400;
            border-radius: 4px;
            text-decoration: none;
        }

        .pagination a:hover {
            background-color: #006400;
            color: #fff;
        }

        .search-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .search-input {
            padding: 8px;
            border: 1px solid #006400;
            border-radius: 4px;
            margin-right: 8px;
        }

        .search-button {
            background-color: #006400;
            color: #fff;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
        }

        .return-button {
            background-color: #006400;
            color: #fff;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }
    </style>
    <title>Healthcare Orders</title>
</head>
<body>
    <div class="search-container">
        <form action="index.php" method="get">
            <input type="text" name="search" class="search-input" placeholder="Search by Order ID">
            <button type="submit" class="search-button">Search</button>
        </form>
    </div>

    <div class="admin-container">
        <?php
        foreach ($paginatedOrders as $order) {
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

    <div class="pagination">
        <?php
        for ($i = 1; $i <= $totalPages; $i++) {
            echo "<a href='index.php?page={$i}'>{$i}</a> ";
        }
        ?>
    </div>

    <?php
    if (isset($searchResult) && empty($searchResult)) {
        echo "<button class='return-button' onclick='goBack()'>Return</button>";
    }
    ?>

    <script src="script.js"></script>
    <script>
        function goBack() {
            window.location.href = 'index.php';
        }
    </script>
</body>
</html>
