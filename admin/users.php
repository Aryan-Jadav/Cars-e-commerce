<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: index.php');
    exit;
}?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Queries Received</title>
	<link rel="stylesheet" type="text/css" href="assets\css\styles.css">
</head>
<?php
include 'db.php';

// Retrieve the form data from the database
$stmt = $conn->prepare("SELECT * FROM user");
$stmt->execute();
$result = $stmt->get_result();

// Get the column names
$field_names = array();
while ($field_info = $result->fetch_field()) {
    $field_names[] = $field_info->name;
}

// Store the results in an array
$submissions = array();
while ($row = $result->fetch_assoc()) {
    $submissions[] = $row;
}

?>
<body>
	<?php include 'admin_nav.php';?>
	<h1>Users</h1>
	<div class="container">
    <div class="table-responsive">
    <table id="selling-car-info">
        <tr>
            <?php foreach ($field_names as $field_name) {?>
                <th id="selling-car-info"><?= ucfirst($field_name)?></th>
            <?php }?>
            <th>Action</th>
        </tr>
         <?php
         $a=1;
             $sql_about="Select * from user order by id desc";
             $result_about=mysqli_query($conn,$sql_about);                            
             while($row_about=mysqli_fetch_assoc($result_about))
             { 
             $id       = $row_about['id'];                          
             $user_name= $row_about['user_name'];
             $email    = $row_about['email'];
             $password  = $row_about['password'];
             $ip_address = $row_about['ip_address'];
             $created_on = $row_about['created_on'];
             $modified_on = $row_about['modified_on'];
         ?>
        <tr>
            <td><?php echo $a; ?></td>
            <td><?php echo $user_name;?></td>
            <td><?php echo $password; ?></td>
            <td><?php echo $email; ?></td>
            <td><?php echo $ip_address; ?></td>
            <td><?php echo $created_on; ?></td>
            <td><?php echo $modified_on; ?></td>
            <th>
                <form action="delete_user.php" method="post" onsubmit="return confirm('Are you sure you want to delete this user?')">
				    <input type="hidden" name="user_id" value="<?= $row_about['id']?>">
				    <button type="submit" id="del">Delete</button>
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
</div>
<?php include 'footer.php';?>