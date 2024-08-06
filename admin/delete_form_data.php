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

// Check if the query_id value is being sent
if (!isset($_POST['query_id']) || empty($_POST['query_id'])) {
    die("No query ID provided");
}

// Get the query_id from the form
$query_id = $_POST['query_id'];

// Delete the query
$stmt = $conn->prepare("DELETE FROM form_part1 WHERE id =?");
$stmt->bind_param("i", $query_id);
$stmt->execute();

// Check if the query was successful
if ($stmt->affected_rows > 0) {
    echo "Query deleted successfully";
} else {
    echo "Error deleting query";
}

// Close the connection
$stmt->close();
$conn->close();

// Redirect back to the original page
header("Location: task1(form_view).php");
exit;
?>