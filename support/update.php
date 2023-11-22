<?php
$submissionIdToUpdate = 1; 

try {
    $stmt = $conn->prepare("UPDATE UserSubmissions SET name = :name, contact = :contact, problem_description = :problem WHERE submission_id = :id");

    $stmt->bindParam(':name', $updatedName);
    $stmt->bindParam(':contact', $updatedContact);
    $stmt->bindParam(':problem', $updatedProblem);
    $stmt->bindParam(':id', $submissionIdToUpdate);

    $stmt->execute();

    echo "Submission updated successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
