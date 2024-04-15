<?php
include 'db.php'; // This includes your database connection

// SQL query to select data from the database
$sql = "SELECT id, name, email, age FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["name"]. " - Email: " . $row["email"]. " - Age: " . $row["age"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
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
    <br><br>
  <div class="container">
    <!-- Create User button -->
  <a href="create.php" class="btn btn-primary mb-3">Create User</a>
   <br>
  <h2>Users List</h2>
  <!-- Updated table classes for Bootstrap 5 -->
  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Age</th>
      </tr>
    </thead>
    <tbody>
  <?php
  include 'db.php'; // include your database connection

  // SQL query to fetch data from the database
  $sql = "SELECT id, name, email, age FROM users";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      // Output data of each row
      while($row = $result->fetch_assoc()) {
          echo "<tr>
                  <td>" . $row["id"] . "</td>
                  <td>" . $row["name"] . "</td>
                  <td>" . $row["email"] . "</td>
                  <td>" . $row["age"] . "</td>
                  <td>
    <!-- Update button -->
    <a href='update.php?id=" . $row["id"] . "' class='btn btn-success btn-sm'>Update</a>
    <!-- Delete button -->
    <a href='delete.php?id=" . $row["id"] . "' onclick='return confirm(\"Are you sure?\")' class='btn btn-danger btn-sm'>Delete</a>
</td>
                </tr>";
      }
  } else {
      echo "<tr><td colspan='5'>No users found</td></tr>";
  }
  $conn->close();
  ?>
</tbody>

  </table>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
