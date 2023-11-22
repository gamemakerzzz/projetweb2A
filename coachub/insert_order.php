<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $deliveryAddress = $_POST['deliveryAddress'];
    $phoneNumber = $_POST['phoneNumber'];
    $deliveryDate = $_POST['deliveryDate'];

    try {
        $stmt = $conn->prepare("INSERT INTO orders (delivery_address, phone_number, order_date) VALUES (?, ?, ?)");
        $stmt->execute([$deliveryAddress, $phoneNumber, $deliveryDate]);
        echo "Delivery created successfully";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
