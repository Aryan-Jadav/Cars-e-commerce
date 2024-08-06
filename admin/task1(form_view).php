<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in']!== true) {
    header('Location: task1(login).php');
    exit;
}

include 'db.php';

// Retrieve the form data from the database
$stmt = $conn->prepare("SELECT id, full_name, phone, email, message FROM form_part1");
$stmt->execute();
$result = $stmt->get_result();

// Store the results in an array
$submissions = array();
while ($row = $result->fetch_assoc()) {
    $submissions[] = $row;
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Queries Received</title>
    <link rel="stylesheet" type="text/css" href="assets\css\styles.css">
</head>
<body>
    <h1>Form Data received</h1>
    <div class="container">
    <table id="selling-car-info">
        <tr>
            <th>S.No</th>
            <th>Full Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Message</th>
            <th>Action</th>
        </tr>
         <?php
         $a=1;
             $sql_about="Select id, full_name, phone, email, message from form_part1"; 
             $result_about=mysqli_query($conn,$sql_about);                            
             while($row_about=mysqli_fetch_assoc($result_about))
             { 
             $id       = $row_about['id'];
             $full_name     = $row_about['full_name'];
             $email    = $row_about['email'];
             $phone = $row_about['phone'];
             $message  = $row_about['message'];
       ?>
        <tr>
            <td><?php echo $a;?></td>
            <td><a href="view_form_data.php?id=<?= $id?>" style="color: #000000"><?= $full_name;?></a></td>
            <td><?= $email;?></td>
            <td><?= $phone;?></td>            
            <td><?= $message;?></td>
            <th>
                <form action="delete_form_data.php" method="post" onsubmit="return confirm('Are you sure you want to delete this query?')">
                    <input type="hidden" name="query_id" value="<?= $id?>">
                    <button type="submit">Delete</button>
                </form>
            </th>
        </tr>
       <?php
                    $a++; // Increment the manual ID
                }

                // Close statement
                $stmt->close();

                // Close connection
                $conn->close();
          ?>
    </table>
</div>
</body>
</html>