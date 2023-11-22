<?php
$servername = "localhost";
//$username = "your_username";
$password = "root";
$dbname = "coachub";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname",$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
