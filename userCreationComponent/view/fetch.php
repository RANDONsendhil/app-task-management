<?php
// Database connection settings
$host = 'localhost'; // Database host (usually localhost for local setups)
$username = 'root'; // MySQL username (default for XAMPP is 'root')
$password = 'randon'; // MySQL password (default for XAMPP is '' which means no password)
$dbname = 'cnam_php'; // The name of your database

// Create a connection to the MySQL database using MySQLi
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch all users
$sql = "SELECT * from users"; // Replace 'users' with your actual table name

// Execute the query
$result = $conn->query($sql);

// Check if query execution was successful
if ($result->num_rows > 0) {
  // Output data for each row
  while ($row = $result->fetch_assoc()) {
    echo "<p>Name: " . htmlspecialchars($row['lname']) . "</p>";
    echo "<p>Age: " . htmlspecialchars($row['fname']) . "</p>";
    echo "<p>City: " . htmlspecialchars($row['numSS']) . "</p><br>";
  }
} else {
  echo "No users found.";
}

// Close the connection
$conn->close();
