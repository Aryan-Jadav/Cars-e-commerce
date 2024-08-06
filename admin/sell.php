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
    <title>Car selling Information</title>
    <link rel="stylesheet" type="text/css" href="assets\css\styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
    <style>
       .image-container {
            display: flex;
        }
       .image-container img {
            width: 100px;
            height: 100px;
            margin: 10px;
        }
        tr{
            background: #FFFFFF;
        }
    </style>
</head>
<?php
include 'db.php';

// Retrieve the form data from the database
$stmt = $conn->prepare("SELECT * FROM selling");
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

// $stmt->close();
// $conn->close();
?>
<body>
    <?php include 'admin_nav.php';?>
    <h1>Selling Car Information</h1>
    <div class="container">
    <div class="table-responsive">
    <table id="selling-car-info">
        <tr>
            <?php foreach ($field_names as $field_name) {?>
                <th><?= ucfirst($field_name)?></th>
            <?php }?>
            <th>Action</th>
        </tr>
         
        <?php
                $a = 1;
                $sql_about="Select * from selling order by id desc";
                $result_about=mysqli_query($conn,$sql_about);                           
                 while($row_about=mysqli_fetch_assoc($result_about)){                           
                    $name           = $row_about['name'];
                    $phone_no       = $row_about['phone_no'];
                    $country        = $row_about['country'];
                    $state          = $row_about['state'];
                    $city           = $row_about['city'];
                    $address        = $row_about['address'];
                    $car_brand      = $row_about['car_brand'];
                    $car_name       = $row_about['car_name'];
                    $car_mod_no     = $row_about['car_mod_no'];
                    $car_no         = $row_about['car_no'];
                    $km_driven      = $row_about['km_driven'];
                    $dents          = $row_about['dents'];
                    $min_sale_price = $row_about['min_sale_price'];
                    $max_sale_price = $row_about['max_sale_price'];
                    $images         = explode(',', $row_about['image']);
               ?>
           <tr>
                <td><?php echo $a;?></td>
                        <td><?php echo $name;?> </td>        
                        <td><?php echo $phone_no;?></td>                          
                        <td><?php echo $country;?>         </td>
                        <td><?php echo $state;?>           </td> 
                        <td><?php echo $city;?>            </td>
                        <td><?php echo $address;?>         </td>
                        <td><?php echo $car_brand;?>            </td>
                        <td><?php echo $car_name;?>             </td>
                        <td><?php echo $car_mod_no;?>         </td>
                        <td><?php echo $car_no;?> </td>
                        <td><?php echo $km_driven;?> </td>
                        <td><?php echo $dents;?>     </td>
                        <td><?php echo $min_sale_price;?>  </td>
                        <td><?php echo $max_sale_price;?>     </td>
                        <td> 
                            <div class="image-container">
                            <?php foreach ($images as $image) {?>
                                <a href="<?php echo '../admin/assets/Images/uploaded_images/'.$image?>" data-fancybox="images-<?php echo $row_about['id']?>" data-caption="<?php echo $image?>">
                                    <img src="<?php echo '../admin/assets/Images/uploaded_images/'.$image?>" width="100" height="100" alt="img">
                                </a>
                            <?php }?>
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('[data-fancybox="images-<?php echo $row_about['id']?>"]').fancybox({
                                        loop: true,
                                        toolbar: true,
                                        buttons: [
                                            "slideShow",
                                            "fullScreen",
                                            "thumbs",
                                            "close"
                                        ]
                                   });
                                });
                            </script>
                        </td>
                        <td>
                            <form action="delete_submission.php" method="post" onsubmit="return confirm('Are you sure you want to delete this submission?')">
                                <input type="hidden" name="id"value="<?php echo $row_about['id'];?>">
                                <button type="submit" id="del">Delete</button>
                            </form>
                        </td>
                   </tr>
            <?php $a++;?>
        <?php }?>
    </table>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
</body>
</html>