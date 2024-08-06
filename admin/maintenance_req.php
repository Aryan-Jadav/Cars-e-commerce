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
    <title>Maintenance Request Received</title>
    <link rel="stylesheet" type="text/css" href="assets\css\styles.css">
</head>
<body>
    <?php include 'admin_nav.php';?>
    <h1>Maintenance Request Received</h1>
    <div class="container">
    <div class="table-responsive">
        <table id="selling-car-info">
            <tr>
                <?php

                include 'db.php';

                // Retrieve the column names from the database
                $stmt = $conn->prepare("SHOW COLUMNS FROM car_maintenance");
                $stmt->execute();
                $result = $stmt->get_result();

                // Display the column names as table headers
                echo "<tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<th>". $row['Field']. "</th>";
                }
                echo "<th>Action</th>";
                echo "</tr>";
            ?>
            </tr>
                <?php
                $a=1;
                    $sql_about="Select * from car_maintenance order by id desc";
                    $result_about=mysqli_query($conn,$sql_about);                           
                    while($row_about=mysqli_fetch_assoc($result_about))
                    {                           
                    $id                 = $row_about['id'];
                    $name               = $row_about['name'];
                    $phone              = $row_about['phone'];
                    $email              = $row_about['email'];
                    $address            = $row_about['address'];
                    $make               = $row_about['make'];
                    $model              = $row_about['model'];
                    $year               = $row_about['year'];
                    $vin                = $row_about['vin'];
                    $license            = $row_about['license'];
                    $lastServiceDate    = $row_about['lastServiceDate'];
                    $previousRecords    = $row_about['previousRecords'];
                    $lastMileage        = $row_about['lastMileage'];
                    $currentMileage     = $row_about['currentMileage'];
                    $knownIssues        = $row_about['knownIssues'];
                    $serviceType        = $row_about['serviceType'];
                    $serviceDate        = $row_about['serviceDate'];
                    $serviceTime        = $row_about['serviceTime'];
                    $serviceLocation    = $row_about['serviceLocation'];
                    $specificRequests   = $row_about['specificRequests'];
                    $paymentMethod      = $row_about['paymentMethod'];
                    $billingAddress     = $row_about['billingAddress'];
                    $insuranceInfo      = $row_about['insuranceInfo'];
                    $warrantyInfo       = $row_about['warrantyInfo'];
                ?>
                <tr>
                    <td><?php echo $a; ?></td>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $phone; ?></td>
                    <td><?php echo $email; ?></td>
                    <td><?php echo $address; ?></td>
                    <td><?php echo $make; ?></td>
                    <td><?php echo $model; ?></td>
                    <td><?php echo $year; ?></td>
                    <td><?php echo $vin; ?></td>
                    <td><?php echo $license; ?></td>
                    <td><?php echo $lastServiceDate; ?></td>
                    <td><?php echo $previousRecords; ?></td>
                    <td><?php echo $lastMileage; ?></td>
                    <td><?php echo $currentMileage; ?></td>
                    <td><?php echo $knownIssues; ?></td>
                    <td><?php echo $serviceType; ?></td>
                    <td><?php echo $serviceDate; ?></td>
                    <td><?php echo $serviceTime; ?></td>
                    <td><?php echo $serviceLocation; ?></td>
                    <td><?php echo $specificRequests; ?></td>
                    <td><?php echo $paymentMethod; ?></td>
                    <td><?php echo $billingAddress; ?></td>
                    <td><?php echo $insuranceInfo; ?></td>
                    <td><?php echo $warrantyInfo; ?></td>
                    <td>
                        <form action="maintenance_req_delete.php" method="post" onsubmit="return confirm('Are you sure you want to delete this query?')">
                            <input type="hidden" name="query_id" value="<?= $row_about['id']?>">
                            <button type="submit" id="del">Delete</button>
                        </form> 
                    </td>
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
</body>
</html>