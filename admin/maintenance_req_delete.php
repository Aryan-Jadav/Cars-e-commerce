<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cars_webpage";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

// Get the query ID from the form
$query_id = $_POST['query_id'];

// Check if the query ID is set and not empty
if (isset($query_id) &&!empty($query_id)) {
    try {
        // Delete the row from the database
        $stmt = $conn->prepare("DELETE FROM car_maintenance WHERE id =?");
        $stmt->bind_param("i", $query_id);
        $stmt->execute();

        // Check if the deletion was successful
        if ($stmt->affected_rows > 0) {
            echo "Deletion successful!<br>";

            // Re-fetch the data from the database
            $stmt = $conn->prepare("SELECT * FROM car_maintenance");
            $stmt->execute();
            $result = $stmt->get_result();

            // Re-render the table with the updated IDs
            $id = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr id='row-{$id}'>";
                foreach ($row as $field => $value) {
                    echo "<td>". $value. "</td>";
                }
              ?>
                <td>
                    <form action="maintenance_req_delete.php" method="post" onsubmit="return confirm('Are you sure you want to delete this query?')">
                        <input type="hidden" name="query_id" value="<?= $row['id']?>">
                        <button type="submit">Delete</button>
                    </form>
                </td>
                <?php
                echo "</tr>";
                $id++; // Increment the manual ID
            }
        } else {
            echo "Deletion failed!<br>";
        }
    } catch (mysqli_sql_exception $e) {
        echo "Error: ". $e->getMessage(). "<br>";
    }
} else {
    echo "Query ID is not set or is empty!<br>";
}

// Close statement
$stmt->close();

// Close connection
$conn->close();

// Redirect back to the maintenance request page
header("Location: maintenance_req.php");
exit;
?>