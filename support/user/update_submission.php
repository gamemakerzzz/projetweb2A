<?php
include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $submissionId = $_POST['submission_id'];
        $updatedName = $_POST['updated_name'];
        $updatedContact = $_POST['updated_contact'];
        $updatedProblem = $_POST['updated_problem'];

        $sql = "UPDATE usersubmissions SET name = :name, contact = :contact, problem_description = :problem WHERE submission_id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':id', $submissionId);
        $stmt->bindParam(':name', $updatedName);
        $stmt->bindParam(':contact', $updatedContact);
        $stmt->bindParam(':problem', $updatedProblem);

        $stmt->execute();

        header("Location: thank_you.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        $conn = null;
    }
} else {
    
    echo "Invalid request method.";
}
?>
