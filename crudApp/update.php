<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['id'])) {
    include 'db.php'; // Include the database connection

    // Collect updated data from the form
    $id = $_GET['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];

    // Prepare SQL to update the record
    $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, age = ? WHERE id = ?");
    $stmt->bind_param("ssii", $name, $email, $age, $id);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Record updated successfully</div>";
    } else {
        echo "<div class='alert alert-danger'>Error updating record: " . $stmt->error . "</div>";
    }

    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body><div class="container">
  <h2>Update User</h2>
  <?php
  include 'db.php'; // include your database connection

  // Get the user ID from the URL parameter
  $id = $_GET['id'];

  // SQL to fetch the specific user
  $sql = "SELECT * FROM users WHERE id = $id";
  $result = $conn->query($sql);

  if ($result->num_rows == 1) {
      $row = $result->fetch_assoc();
  ?>
      <form action="update.php?id=<?php echo $row['id']; ?>" method="post">
          <!-- Bootstrap 5 uses "mb-3" instead of "form-group" for spacing -->
          <div class="mb-3">
              <label for="name" class="form-label">Name:</label>
              <input type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>" required>
          </div>
          <div class="mb-3">
              <label for="email" class="form-label">Email:</label>
              <input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>" required>
          </div>
          <div class="mb-3">
              <label for="age" class="form-label">Age:</label>
              <input type="number" class="form-control" name="age" value="<?php echo $row['age']; ?>" required>
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
          <!-- Cancel button -->
          <a href="index.php" class="btn btn-secondary">Cancel</a>
      </form>
  <?php
  } else {
      echo "User not found.";
  }
  $conn->close();
  ?>
</div>



</body>
</html>
