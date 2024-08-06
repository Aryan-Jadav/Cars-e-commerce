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
	<title>Sell Cars</title>
	<link rel="stylesheet" type="text/css" href="assets\css\styles.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
	<script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
	<style>	

.imageThumb {
	max-height: 75px;
	border: 0px solid;
	padding: 1px;
	cursor: pointer;
}
.pip {
	display: inline-block;
	margin: 10px 10px 0 0;
}
.remove {
	display: block;
	background: #444;
	border: 1px solid #444;
	color: white;
	text-align: center;
	cursor: pointer;
}
.remove:hover {
	background: white;
	color: black;
}
.img-thumbnail {
	padding: 4px;
	line-height: 1.42857;
	background-color: #fff;
	border: 1px solid #ddd;
	border-radius: 3px;
	-webkit-transition: all 0.2s ease-in-out;
	-o-transition: all 0.2s ease-in-out;
	transition: all 0.2s ease-in-out;
	display: inline-block;
	max-width: 100%;
	height: auto;
}
img {
	vertical-align: middle;
}

</style>
</head>
<?php
include 'db.php';
$page = isset($_GET['page']) ? $_GET['page'] : '';if(isset($_GET['status'])){
	$status = $_GET['status'];
	$status_id = $_GET['statusid'];
	if($status=='block')
	{
		mysqli_query($conn,"update buying set status='unblock' where id='$status_id'");
	}
	else if($status=='unblock')
	{
		mysqli_query($conn,"update buying set status='block' where id='$status_id'");
	}
}
// Retrieve the form data from the database
$stmt = $conn->prepare("SELECT * FROM buying");
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
	<?php if($page=='') { ?>
	<div class="px-3">
        <!-- Start Content-->
		<div class="container-fluid">			
			<!-- start page title -->
			<div class="py-3 py-lg-4">
				<div class="row">
					<div class="col-lg-10">
					</div>
					<div class="col-lg-2">
					   <div class="d-none d-lg-block">
						<a href="sell_car.php?page=add" class="btn btn-outline-primary waves-effect waves-light">Sell Car</a>
					   </div>
					</div>
				</div>
			</div>
			<!-- end page title -->
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<h4 class="header-title pb-2">Sell Car </h4>
							<div class="table-responsive">
							<table id="basic-datatable" class="table dt-responsive contextual table-bordered nowrap w-100 selling-car-info">
								<thead>
									<tr>
        							    <?php foreach ($field_names as $field_name) {?>
        							        <th id="selling-car-info"><?= ucfirst($field_name)?></th>
        							    <?php }?>
        							    <th>Action</th>
        							</tr>
								</thead>						
								<tbody>
								<?php
								$a=1;
									$sql_about="Select * from buying order by id desc";
									$result_about=mysqli_query($conn,$sql_about);							
									while($row_about=mysqli_fetch_assoc($result_about))
									{							
									$id       		 	= $row_about['id']; 			
             						$car_name			= $row_about['car_name'];
             						$og_price			= $row_about['og_price'];
             						$new_price			= $row_about['new_price'];
             						$car_image	   	 	= $row_about['car_image'];
             						$status  		 	= $row_about['status'];			
								?>
								<tr>
									<td><?php echo $a; ?></td>							
									<td><?php echo $car_name; ?></td>
									<td><?php echo $og_price; ?></td>
									<td><?php echo $new_price; ?></td>						
									<td>
								    <div class="image-container">
								        <?php if ($car_image) { ?>
								            <a href="<?php echo 'Sell Car/'.$car_image?>" data-fancybox="images-<?php echo $row_about['id']?>" data-caption="<?php echo $car_image?>">
								                <img src="<?php echo 'Sell Car/'.$car_image?>" width="100" height="100" alt="img">
								            </a>
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
								        <?php } else { ?>
								            <p>No images uploaded.</p>
								        <?php } ?>
								    </div>
									</td>
									<td>
									    <?php if($status == 'unblock'){ ?>
									        <a href="sell_car.php?status=<?php echo $status; ?>&statusid=<?php echo $id; ?>" class="badge bg-success">Approved</a>
									    <?php } elseif($status == 'block'){ ?>
									        <a href="sell_car.php?status=<?php echo $status; ?>&statusid=<?php echo $id; ?>" class="badge bg-danger">Denied</a>
									    <?php } else { ?>
									        <span class="badge bg-warning">Pending</span>
									    <?php } ?>
									</td>								
									<td>
										<a class="btn btn-primary btn-sm" href="sell_car.php?page=edit&edit_id=<?php echo $id; ?>" title="Edit">Edit</a>
										<a class="btn btn-danger btn-sm" href="sell_car.php?page=delete&delete_id=<?php echo $id; ?>" onclick="return confirm('Are you sure you want to Remove?');" title="Delete">Delete</a>
									</td>
								</tr>
								<?php $a++; } ?>
								</tbody>
							</table>
							</div>
						</div> <!-- end card body-->
					</div> <!-- end card -->
				</div><!-- end col-->
			</div>
			<!-- end row-->
		</div><!-- end col-->
	</div>
	<?php } ?>
	<?php if($page=='add') { ?>
	<div class="px-3">
        <!-- Start Content-->
		<div class="container-fluid">			
			<div class="py-3 py-lg-4">
				<div class="row">
					<div class="col-lg-6">
						<h4 class="page-title mb-0">Add Car</h4>
					</div>
					<div class="col-lg-6">
					   <div class="d-none d-lg-block">
						<ol class="breadcrumb m-0 float-end">
							<li class="breadcrumb-item"><a href="sell_car.php">sell_car</a></li>
							<li class="breadcrumb-item active">add selling car</li>
						</ol>
					   </div>
					</div>
				</div>
			</div>
			<!-- end page title -->
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-body">
							<h2 class=" text-center pb-2">Add Car</h2>
							<hr>
							<form class="needs-validation" method="post" action="sell_car.php?page=insert" enctype="multipart/form-data">
								<div class="mb-3">
									<label for="car_name" class="form-label fw-bold">Car Name</label>
									<input type="text" class="form-control" name="car_name" id="car_name" placeholder="Enter Car Name">
								</div>								
								<div class="mb-3">
									<label for="car_image" class="form-label fw-bold">Car Image</label>
									<input type="file" class="form-control" name="car_image" id="car_image">
								</div>
								<div class="mb-3">
									<label for="og_price" class="form-label fw-bold">Original price</label>
									<input type="text" class="form-control" name="og_price" id="og_price" placeholder="Enter Original Price">
								</div>
								<div class="mb-3">
									<label for="new_price" class="form-label fw-bold">Discounted Price</label>
									<input type="text" class="form-control" name="new_price" id="new_price" placeholder="Enter Discounted Price">
								</div>								
								<div class="mt-4">
		                        	<button class="btn btn-primary" type="submit">Sell Car</button>
		                        	<a href="<?php echo $_SERVER['HTTP_REFERER'];?>" class="btn btn-primary">Back</a>
		                        </div>
							</form>
						</div> <!-- end card-body-->
					</div> <!-- end card-->
				</div> <!-- end col-->
			</div><!-- end row-->
		</div>
	</div>
	<?php }?>
	
<?php 
	if($page=='insert'){ 
		$car_name 			= $_POST['car_name'];
		$og_price 			= $_POST['og_price'];
		$new_price			= $_POST['new_price'];		
		$file_type1 		= $_FILES['car_image']['type'];
		$file_tmp1 			= $_FILES['car_image']['tmp_name'];
		$file_nm1 			= $_FILES['car_image']['name'];
		$file_nm1 			= str_replace(" ","-",$file_nm1);
		if($file_nm1){
			$mimetype = @mime_content_type($_FILES['car_image']['tmp_name']);
			if(in_array($mimetype, array('image/jpeg', 'image/JPEG', 'image/JPG', 'image/jpg', 'image/gif', 'image/png', 'image/PNG')))
			{
				$folder1 = "Sell Car/";
				$img_filename1 = $folder1.time().$file_nm1;
				$car_image = time().$file_nm1;
				move_uploaded_file($file_tmp1,$img_filename1);
			} else {
				$car_image = '';
			}
		} else {
			$car_image = '';
		}		
		$sql_insert = "INSERT into buying SET 
			`car_name` = '".$car_name."',
			`og_price` = '".$og_price."', 
			`car_image` = '".$car_image."', 
			`new_price` = '".$new_price."'";
		
		$result = mysqli_query($conn,$sql_insert);
		echo "<script>alert('Row inserted successfully.'); window.location.href='sell_car.php';</script>";
	}?>

	<?php
if ($page == 'edit') {
    $edit_id = $_GET['edit_id'];
    $sql_select = "SELECT * FROM buying WHERE id = '$edit_id'";
    $result_sell_car = mysqli_query($conn, $sql_select);
    $row_sell_car = mysqli_fetch_assoc($result_sell_car);
    $car_name = $row_sell_car['car_name'];
    $og_price = $row_sell_car['og_price'];
    $car_image = $row_sell_car['car_image'];
    $new_price = $row_sell_car['new_price'];
?>
<div class="px-3">
    <!-- Start Content-->
    <div class="container-fluid">            
        <div class="py-3 py-lg-4">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="page-title mb-0">Edit Car</h4>
                </div>
                <div class="col-lg-6">
                   <div class="d-none d-lg-block">
                    <ol class="breadcrumb m-0 float-end">
                        <li class="breadcrumb-item"><a href="sell_car.php">Sell Car</a></li>
                        <li class="breadcrumb-item active">Edit Car</li>
                    </ol>
                   </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center pb-2">Edit Category</h2>
                        <hr>
                        <form class="needs-validation" method="post" action="sell_car.php?page=update" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="car_name" class="form-label fw-bold">Car Name</label>
                                <input type="text" class="form-control" name="car_name" value="<?php echo $car_name; ?>" required>
                                <input type="hidden" class="form-control" name="edit_id" id="edit_id" value="<?php echo $edit_id; ?>">
                            </div>                            
                            <div class="mb-3">
                                <label for="og_price" class="form-label fw-bold">Original Price</label>
                                <input type="text" class="form-control" name="og_price" value="<?php echo $og_price; ?>" required>
                                <input type="hidden" class="form-control" name="edit_id" id="edit_id" value="<?php echo $edit_id; ?>">
                            </div>
                            <div class="mb-3">
							    <label for="car_image" class="form-label fw-bold">Car Image</label>
							    <input type="file" class="form-control" name="car_image">
							    <input type="hidden" name="current_car_image" value="<?php echo $car_image; ?>">
							    <?php if ($car_image) { ?>
							        <img src="Sell Car/<?php echo $car_image; ?>" alt="Car Image" width="100">
							        <button type="button" class="btn btn-danger" onclick="deleteImage('<?php echo $car_image; ?>', 'single')">Delete</button>
							    <?php } ?>
							</div>
                            <div class="mb-3">
                                <label for="new_price" class="form-label fw-bold">Discounted Price</label>
                                <input type="text" class="form-control" name="new_price" value="<?php echo $new_price; ?>" required>
                                <input type="hidden" class="form-control" name="edit_id" id="edit_id" value="<?php echo $edit_id; ?>">
                            </div>                            
                            <div class="mt-4">
                                <button class="btn btn-primary" type="submit" name="update">Update</button>
                                <a href="<?php echo $_SERVER['HTTP_REFERER'];?>" class="btn btn-primary">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<?php
if ($page == 'update') {
    $edit_id = $_POST['edit_id'];
    $car_name = $_POST['car_name'];
    $og_price = $_POST['og_price'];
    $new_price = $_POST['new_price'];
// Retrieve existing car image
$car_image = '';
if ($_FILES['car_image']['name']) {
    $file_type1 = $_FILES['car_image']['type'];
    $file_tmp1 = $_FILES['car_image']['tmp_name'];
    $file_nm1 = $_FILES['car_image']['name'];
    $file_nm1 = str_replace(" ", "-", $file_nm1);
    if ($file_nm1) {
        $mimetype = @mime_content_type($_FILES['car_image']['tmp_name']);
        if (in_array($mimetype, array('image/jpeg', 'image/jpg', 'image/gif', 'image/png'))) {
            $folder1 = "Sell Car/";
            $img_filename1 = $folder1.time().$file_nm1;
            $car_image = time().$file_nm1;
            move_uploaded_file($file_tmp1, $img_filename1);
        }
    }
} else {
    $sql_get_imagess = "SELECT car_image FROM buying WHERE id = '$edit_id'";
    $result_get_imagess = mysqli_query($conn, $sql_get_imagess);
    $row_get_imagess = mysqli_fetch_assoc($result_get_imagess);
    $car_image = $row_get_imagess['car_image'];
}
    // Update the database
    $sql_update = "UPDATE buying SET 
        `car_name` = '".$car_name."', 
        `og_price` = '".$og_price."', 
        `car_image` = '".$car_image."', 
        `new_price` = '".$new_price."'
        WHERE id = '$edit_id'";
    $result = mysqli_query($conn, $sql_update);
    echo "<script>alert('Category Updated successfully.'); window.location.href='sell_car.php';</script>";
}
?>	
<!---delete -->
<?php if($page=='delete'){
	$delete_id = $_GET['delete_id'];
	$sql = "DELETE FROM buying WHERE id = '$delete_id'";
	$result_library = mysqli_query($conn,$sql);
	echo "<script>window.location.href='sell_car.php'</script>";
}?>
<?php include('footer.php');?>
<script>
$(document).ready(function() {
	if (window.File && window.FileList && window.FileReader) {
		$("#blog_image").on("change", function(e) {
			var files = e.target.files,
			filesLength = files.length;
			for (var i = 0; i < filesLength; i++) {
				var f = files[i]
				var fileReader = new FileReader();
				fileReader.onload = (function(e) {
				var file = e.target;
				$("<span class=\"pip\">" +
					"<img class=\"imageThumb img-thumbnail\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +"<span class=\"remove\">Remove</span>" +
					"</span>").insertAfter("#blog_image");
					$(".remove").click(function(){
						$(this).parent(".pip").remove();
					});
				});
				fileReader.readAsDataURL(f);
			}
		});
	} else {
		alert("Your browser doesn't support to File API")
	}
	/* image preview end */	
});

function deleteImage(imageName, imageType) {
    if (confirm("Are you sure you want to delete this image?")) {
        // Send an AJAX request to delete the image
        $.ajax({
            type: "POST",
            url: "delete_image1.php",
            data: { image: imageName, type: imageType },
            success: function(response) {
                // Remove the image from the page
                $('img[src="Sell Car/' + imageName + '"]').remove();
                $('button[onclick="deleteImage(\'' + imageName + '\', \'' + imageType + '\')"]').remove();
                alert(response);
            }
        });
    }
}
</script>
</body>