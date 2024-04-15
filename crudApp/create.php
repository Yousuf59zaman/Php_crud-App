<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db.php'; // Include your DB connection

    // Collect post data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];

    // Prepare an SQL statement to avoid SQL injection
    $stmt = $conn->prepare("INSERT INTO users (name, email, age) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $name, $email, $age); // 'ssi' means string, string, integer

    // Execute the statement and check for errors
    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>New record created successfully</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
    }
    
    $stmt->close();
    $conn->close();
    header("Location: index.php"); // Redirect back to the read page
exit;
}
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crud App using PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
    <h2>Add New User</h2>
    <form action="create.php" method="post">
      <!-- Bootstrap 5 has replaced "form-group" with "mb-3" for margin bottom -->
      <div class="mb-3">
        <label for="name" class="form-label">Name:</label>
        <input type="text" class="form-control" id="name" name="name" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="mb-3">
        <label for="age" class="form-label">Age:</label>
        <input type="number" class="form-control" id="age" name="age" required>
      </div>
      <!-- Bootstrap 5 uses "btn btn-primary" as before, so no change needed for the button -->
      <button type="submit" class="btn btn-primary">Submit</button>
      <!-- Cancel button -->
      <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
