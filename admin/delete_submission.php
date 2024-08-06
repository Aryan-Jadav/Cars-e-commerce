<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cars_webpage";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

// Get the id from the form
$id = $_POST['id'];

// Delete the submission
$stmt = $conn->prepare("DELETE FROM selling WHERE id =?");
$stmt->bind_param("i", $id);
$stmt->execute();

// Close the connection
$stmt->close();
$conn->close();

// Redirect back to the original page
header("Location: sell.php");
exit;
?>