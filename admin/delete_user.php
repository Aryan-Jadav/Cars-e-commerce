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

// Check if the user_id value is being sent
if (!isset($_POST['user_id']) || empty($_POST['user_id'])) {
    die("No user ID provided");
}

// Get the user_id from the form
$user_id = $_POST['user_id'];

// Delete the user
$stmt = $conn->prepare("DELETE FROM user WHERE id =?");
$stmt->bind_param("i", $user_id);
$stmt->execute();

// Check if the user was successful
if ($stmt->affected_rows > 0) {
    echo "user deleted successfully";
} else {
    echo "Error deleting user";
}

// Close the connection
$stmt->close();
$conn->close();

// Redirect back to the original page
header("Location: users.php");
exit;
?>