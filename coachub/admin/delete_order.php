<?php
// delete_order.php
include '../db_connection.php';


$order_id = $_GET['order_id'];

try {
    // Delete order
    $stmt = $conn->prepare("DELETE FROM orders WHERE order_id = :order_id");
    $stmt->bindParam(':order_id', $order_id);
    $stmt->execute();

    echo "Order deleted successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
