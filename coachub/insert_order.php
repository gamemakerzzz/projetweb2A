<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $deliveryAddress = $_POST['deliveryAddress'];
    $phoneNumber = $_POST['phoneNumber'];
    $deliveryDate = $_POST['deliveryDate'];
    $specialInstructions = $_POST['specialInstructions'];

    try {
        $stmt = $conn->prepare("INSERT INTO orders (delivery_address, phone_number, preferred_delivery_datetime, special_instructions) VALUES (?, ?, ?, ?)");
        $stmt->execute([$deliveryAddress, $phoneNumber, $deliveryDate, $specialInstructions]);

        $lastOrderId = $conn->lastInsertId();

        if (isset($_POST['products']) && is_array($_POST['products'])) {
            foreach ($_POST['products'] as $productName => $productDetails) {
                $quantity = $productDetails['quantity'];
                $price = 50; // Replace with your default price or logic to determine the price
                $totalPrice = $quantity * $price;

                $stmtOrderItems = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, total_price) VALUES (?, ?, ?, ?)");
                $stmtOrderItems->execute([$lastOrderId, $productName, $quantity, $totalPrice]);
            }
        }

        echo "Delivery created successfully";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
