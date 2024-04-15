<?php
if (isset($_GET['id'])) {
    include 'db.php'; // Include your database connection

    // Get the ID from the URL parameter
    $id = $_GET['id'];

    // Prepare a delete statement
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id); // 'i' indicates the type is integer

    // Execute the statement and check if it works
    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Record deleted successfully</div>";
    } else {
        echo "<div class='alert alert-danger'>Error deleting record: " . $stmt->error . "</div>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<div class='alert alert-danger'>Error: No ID provided</div>";
}

header("Location: index.php"); // Redirect back to the read page
exit;
?>
