<?php
$servername = "localhost";
$password = "root";
$dbname = "support";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
