<?php
// Replace these values with your actual database information
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "cybersecurity_writeups";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO writeups (title, author, content) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $title, $author, $content);

// Set parameters and execute
$title = $_POST['title'];
$author = $_POST['author'];
$content = $_POST['content'];
$stmt->execute();

echo "New records created successfully";

$stmt->close();
$conn->close();
?>
