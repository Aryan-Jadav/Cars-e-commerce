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
	<title>Add Cars</title>
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
		mysqli_query($conn,"update categories set status='unblock' where id='$status_id'");
	}
	else if($status=='unblock')
	{
		mysqli_query($conn,"update categories set status='block' where id='$status_id'");
	}
}
// Retrieve the form data from the database
$stmt = $conn->prepare("SELECT * FROM categories");
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
						<a href="add_car.php?page=add" class="btn btn-outline-primary waves-effect waves-light">Add Car</a>
					   </div>
					</div>
				</div>
			</div>
			<!-- end page title -->
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<h4 class="header-title pb-2">Add Car </h4>
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
									$sql_about="Select * from categories order by id desc";
									$result_about=mysqli_query($conn,$sql_about);							
									while($row_about=mysqli_fetch_assoc($result_about))
									{							
									$id       		 	= $row_about['id'];                  
             						$car_image	   	 	= $row_about['car_image'];
             						$car_name    		= $row_about['car_name'];
             						$car_description 	= $row_about['car_description'];
             						$car_category 	 	= $row_about['car_category'];
             						$car_brand  	 	= $row_about['car_brand'];
             						$status  		 	= $row_about['status'];
             						$car_detail_img	 	= $row_about['car_detail_img'];
             						$car_make			= $row_about['car_make'];
             						$model 			 	= $row_about['model'];
             						$year		 	 	= $row_about['year'];
             						$trim_lvl 		 	= $row_about['trim_lvl'];
             						$Engine  		 	= $row_about['Engine'];
             						$hp					= $row_about['hp'];
             						$transmission		= $row_about['transmission'];
             						$drivetrain			= $row_about['drivetrain'];
             						$fuel 				= $row_about['fuel'];
             						$dimensions			= $row_about['dimensions'];
             						$curb_weight		= $row_about['curb_weight'];
             						$cargo_capacity		= $row_about['cargo_capacity'];
             						$speed				= $row_about['speed'];
             						$top_speed			= $row_about['top_speed'];
             						$breaking_d			= $row_about['breaking_d'];
             						$fuel_eff			= $row_about['fuel_eff'];
             						$interior			= $row_about['interior'];
             						$Infotainment		= $row_about['Infotainment'];
             						$Safety				= $row_about['Safety'];
             						$Exterior			= $row_about['Exterior'];
             						$base_price			= $row_about['base_price'];
             						$diff_price			= $row_about['diff_price'];
             						$exp_rev			= $row_about['exp_rev'];
             						$cust_rev			= $row_about['cust_rev'];
             						$rating				= $row_about['rating'];
             						$warranty			= $row_about['warranty'];
             						$main_sch			= $row_about['main_sch'];
             						$additional_info	= $row_about['additional_info'];
								?>
								<tr class="gradeX">
									<td><?php echo $a; ?></td>
									<td>
								    <div class="image-container">
								        <?php if ($car_image) { ?>
								            <a href="<?php echo 'Add Car/'.$car_image?>" data-fancybox="images-<?php echo $row_about['id']?>" data-caption="<?php echo $car_image?>">
								                <img src="<?php echo 'Add Car/'.$car_image?>" width="100" height="100" alt="img">
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
									<td><?php echo $car_name; ?></td>
									<td><?php echo $car_description; ?></td>
									<td><?php echo $car_category; ?></td>
									<td><?php echo $car_brand; ?></td>
									<?php if($status=='unblock'){?>
									<td ><a href="add_car.php?status=<?php echo $status; ?>&statusid=<?php echo $id; ?>" class="badge bg-success">Approved</a></td>
									<?php }else if($status=='block') {?>
									<td ><a href="add_car.php?status=<?php echo $status; ?>&statusid=<?php echo $id; ?>" class="badge bg-danger">Denied</a></td>
									<?php }?>
									<td>
									  <div class="image-container">
									    <?php
									    if (!empty($car_detail_img)) {
									      $image_array = explode(',', $car_detail_img);
									    ?>
									      <div class="grid-container" style="display: grid; grid-template-columns: repeat(5, 100px); gap: 10px;">
									        <?php
									        foreach($image_array as $image) {
									          $image_url = 'Add Car/'. $image;
									        ?>
									          <a href="<?php echo $image_url?>" data-fancybox="images-<?php echo $row_about['id']?>">
									            <img src="<?php echo $image_url?>" alt="img" style="width: 100px; height: 100px; object-fit: contain;">
									          </a>
									          <?php
									        }
									      ?>
									      </div>
									      <?php
									    } else {
									      echo "No images available";
									    }
									  ?>
									  </div>
									  <script>
									    $(document).ready(function() {
									      $('[data-fancybox="images-<?php echo $row_about['id']?>"]').fancybox({
									        type: 'image',
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
									<td><?php echo $car_make; ?></td>
									<td><?php echo $model; ?></td>
									<td><?php echo $year; ?></td>
									<td><?php echo $trim_lvl; ?></td>
									<td><?php echo $Engine; ?></td>
									<td><?php echo $hp; ?></td>
									<td><?php echo $transmission; ?></td>
									<td><?php echo $drivetrain; ?></td>
									<td><?php echo $fuel; ?></td>
									<td><?php echo $dimensions; ?></td>
									<td><?php echo $curb_weight; ?></td>
									<td><?php echo $cargo_capacity; ?></td>
									<td><?php echo $speed; ?></td>
									<td><?php echo $top_speed; ?></td>
									<td><?php echo $breaking_d; ?></td>
									<td><?php echo $fuel_eff; ?></td>
									<td><?php echo $interior; ?></td>
									<td><?php echo $Infotainment; ?></td>
									<td><?php echo $Safety; ?></td>
									<td><?php echo $Exterior; ?></td>
									<td><?php echo $base_price; ?></td>
									<td><?php echo $diff_price; ?></td>
									<td><?php echo $exp_rev; ?></td>
									<td><?php echo $cust_rev; ?></td>
									<td><?php echo $rating; ?></td>
									<td><?php echo $warranty; ?></td>
									<td><?php echo $main_sch; ?></td>
									<td><?php echo $additional_info; ?></td>
									<td>
										<a class="btn btn-primary btn-sm" href="add_car.php?page=edit&edit_id=<?php echo $id; ?>" title="Edit">Edit</a>
										<a class="btn btn-danger btn-sm" href="add_car.php?page=delete&delete_id=<?php echo $id; ?>" onclick="return confirm('Are you sure you want to Remove?');" title="Delete">Delete</a>
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
							<li class="breadcrumb-item"><a href="add_car.php">add_car</a></li>
							<li class="breadcrumb-item active">add new car</li>
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
							<form class="needs-validation" method="post" action="add_car.php?page=insert" enctype="multipart/form-data">
								<div class="mb-3">
									<label for="car_name" class="form-label fw-bold">Car Name</label>
									<input type="text" class="form-control" name="car_name" id="car_name" placeholder="Enter Car Name">
								</div>
								<div class="mb-3">
									<label for="car_category" class="form-label fw-bold">Car Category</label>
									<select id="car_category" name="car_category">
  								  <option value="">Select an option</option>
  								  <option value="Hatchback">Hatchback</option>
  								  <option value="Coupe">Coupe</option>
  								  <option value="Crossover">Crossover</option>
  								  <option value="MPV">MPV</option>
  								  <option value="SUV">SUV</option>
  								  <option value="Convertible">Convertible</option>
  								  <option value="Sedan">Sedan</option>
  								  <option value="Sports">Sports</option>
  								  <option value="Premium/Luxury">Premium/Luxury</option>
  								  <option value="Jeep">Jeep</option>
  								</select>
								</div>
								<div class="mb-3">
									<label for="car_brand" class="form-label fw-bold">Car Brand</label>
									<select id="car_brand" name="car_brand">
  									<option value="">Select an option</option>
  									<option value="Acura">Acura</option>
  									<option value="Alfa-Romeo">Alfa-Romeo</option>
  									<option value="AM-General">AM-General</option>
  									<option value="Aston-Martin">Aston-Martin</option>
  									<option value="Audi">Audi</option>
  									<option value="Bentley">Bentley</option>
  									<option value="BMW">BMW</option>
  									<option value="Buick">Buick</option>
  									<option value="Cadillac">Cadillac</option>
  									<option value="Chevrolet">Chevrolet</option>
  									<option value="Chrysler">Chrysler</option>
  									<option value="Dodge">Dodge</option>
  									<option value="Ferrari">Ferrari</option>
  									<option value="Fiat">Fiat</option>
  									<option value="Ford">Ford</option>
  									<option value="Freightliner">Freightliner</option>
  									<option value="Genesis">Genesis</option>
  									<option value="GMC">GMC</option>
  									<option value="Honda">Honda</option>
  									<option value="Hummer">Hummer</option>
  									<option value="Hyundai">Hyundai</option>
  									<option value="Infiniti">Infiniti</option>
  									<option value="Isuzu">Isuzu</option>
  									<option value="Jaguar">Jaguar</option>
  									<option value="Jeep">Jeep</option>
  									<option value="Kia">Kia</option>
  									<option value="Lamborghini">Lamborghini</option>
  									<option value="Land-Rover">Land-Rover</option>
  									<option value="Lexus">Lexus</option>
  									<option value="Lincoln">Lincoln</option>
  									<option value="Lotus">Lotus</option>
  									<option value="Maserati">Maserati</option>
  									<option value="Maybach">Maybach</option>
  									<option value="Mazda">Mazda</option>
  									<option value="McLaren">McLaren</option>
  									<option value="Mercedes-Benz">Mercedes-Benz</option>
  									<option value="Mercury">Mercury</option>
  									<option value="MG">MG</option>
  									<option value="Mini">Mini</option>
  									<option value="Mitsubishi">Mitsubishi</option>
  									<option value="Nissan">Nissan</option>
  									<option value="Oldsmobile">Oldsmobile</option>
  									<option value="Pontiac">Pontiac</option>
  									<option value="Porsche">Porsche</option>
  									<option value="Plymouth">Plymouth</option>
  									<option value="Ram">Ram</option>
  									<option value="Rolls-Royce">Rolls-Royce</option>
  									<option value="Saab">Saab</option>
  									<option value="Saturn">Saturn</option>
  									<option value="Scion">Scion</option>
  									<option value="Smart">Smart</option>
  									<option value="Subaru">Subaru</option>
  									<option value="Suzuki">Suzuki</option>
  									<option value="Tesla">Tesla</option>
  									<option value="Toyota">Toyota</option>
  									<option value="Volkswagen">Volkswagen</option>
  									<option value="Volvo">Volvo</option>
  								</select>
								</div>
								<div class="mb-3">
									<label for="car_image" class="form-label fw-bold">Car Image</label>
									<input type="file" class="form-control" name="car_image" id="car_image">
								</div>
								<div class="mb-5">
									<label for="car_description" class="form-label fw-bold">Car Description</label>
									<textarea class="form-control ckeditor" name="car_description" id="car_description"></textarea>
								</div>
								<h2>Add detail information</h2>
								<div class="mb-3">
									<label for="car_detail_img" class="form-label fw-bold">Car Gallary Image</label>
									<input type="file" class="form-control" name="car_detail_img[]" id="car_detail_img" multiple>
								</div>
								<div class="mb-3">
									<label for="car_make" class="form-label fw-bold">Car Make Name</label>
									<input type="text" class="form-control" name="car_make" id="car_make" placeholder="Enter Car Make Name">
								</div>
								<div class="mb-3">
									<label for="model" class="form-label fw-bold">Car Model Name</label>
									<input type="text" class="form-control" name="model" id="model" placeholder="Enter Car Model Name">
								</div>
								<div class="mb-3">
									<label for="year" class="form-label fw-bold">Car launch Date</label>
									<input type="date" class="form-control" name="year" id="year">
								</div>
								<div class="mb-5">
									<label for="trim_lvl" class="form-label fw-bold">Trim Level</label>
									<textarea class="form-control ckeditor" name="trim_lvl" id="trim_lvl"></textarea>
								</div>
								<div class="mb-5">
									<label for="Engine" class="form-label fw-bold">Engine Type and Displacement</label>
									<textarea class="form-control ckeditor" name="Engine" id="Engine"></textarea>
								</div>
								<div class="mb-5">
									<label for="hp" class="form-label fw-bold">Horsepower and Torque</label>
									<textarea class="form-control ckeditor" name="hp" id="hp"></textarea>
								</div>
								<div class="mb-5">
									<label for="transmission" class="form-label fw-bold">Transmission Type</label>
									<textarea class="form-control ckeditor" name="transmission" id="transmission"></textarea>
								</div>
								<div class="mb-5">
									<label for="drivetrain" class="form-label fw-bold">Drivetrain</label>
									<textarea class="form-control ckeditor" name="drivetrain" id="drivetrain"></textarea>
								</div>
								<div class="mb-5">
									<label for="fuel" class="form-label fw-bold">Fuel Type and Fuel Economy</label>
									<textarea class="form-control ckeditor" name="fuel" id="fuel"></textarea>
								</div>
								<div class="mb-5">
									<label for="dimensions" class="form-label fw-bold">Dimensions</label>
									<textarea class="form-control ckeditor" name="dimensions" id="dimensions"></textarea>
								</div>
								<div class="mb-5">
									<label for="curb_weight" class="form-label fw-bold">Curb Weight</label>
									<textarea class="form-control ckeditor" name="curb_weight" id="curb_weight"></textarea>
								</div>
								<div class="mb-5">
									<label for="cargo_capacity" class="form-label fw-bold">Cargo Capacity</label>
									<textarea class="form-control ckeditor" name="cargo_capacity" id="cargo_capacity"></textarea>
								</div>
								<div class="mb-5">
									<label for="speed" class="form-label fw-bold">0-60 mph/ 0-100 kmph Time</label>
									<textarea class="form-control ckeditor" name="speed" id="speed"></textarea>
								</div>
								<div class="mb-5">
									<label for="top_speed" class="form-label fw-bold">Top Speed</label>
									<textarea class="form-control ckeditor" name="top_speed" id="top_speed"></textarea>
								</div>
								<div class="mb-5">
									<label for="breaking_d" class="form-label fw-bold">Braking Distance</label>
									<textarea class="form-control ckeditor" name="breaking_d" id="breaking_d"></textarea>
								</div>
								<div class="mb-5">
									<label for="fuel_eff" class="form-label fw-bold">Fuel Efficiency</label>
									<textarea class="form-control ckeditor" name="fuel_eff" id="fuel_eff"></textarea>
								</div>
								<div class="mb-5">
									<label for="interior" class="form-label fw-bold">Interior</label>
									<textarea class="form-control ckeditor" name="interior" id="interior"></textarea>
								</div>
								<div class="mb-5">
									<label for="Infotainment" class="form-label fw-bold">Infotainment System</label>
									<textarea class="form-control ckeditor" name="Infotainment" id="Infotainment"></textarea>
								</div>
								<div class="mb-5">
									<label for="Safety" class="form-label fw-bold">Safety Features</label>
									<textarea class="form-control ckeditor" name="Safety" id="Safety"></textarea>
								</div>
								<div class="mb-5">
									<label for="Exterior" class="form-label fw-bold">Exterior Features</label>
									<textarea class="form-control ckeditor" name="Exterior" id="Exterior"></textarea>
								</div>
								<div class="mb-5">
									<label for="base_price" class="form-label fw-bold">Base Price</label>
									<textarea class="form-control ckeditor" name="base_price" id="base_price"></textarea>
								</div>
								<div class="mb-5">
									<label for="diff_price" class="form-label fw-bold">Price for Different Trims</label>
									<textarea class="form-control ckeditor" name="diff_price" id="diff_price"></textarea>
								</div>
								<div class="mb-5">
									<label for="exp_rev" class="form-label fw-bold">Expert Reviews</label>
									<textarea class="form-control ckeditor" name="exp_rev" id="exp_rev"></textarea>
								</div>
								<div class="mb-5">
									<label for="cust_rev" class="form-label fw-bold">Customer Reviews</label>
									<textarea class="form-control ckeditor" name="cust_rev" id="cust_rev"></textarea>
								</div>
								<div class="mb-5">
									<label for="rating" class="form-label fw-bold">Ratings from Automotive Publications</label>
									<textarea class="form-control ckeditor" name="rating" id="rating"></textarea>
								</div>
								<div class="mb-5">
									<label for="warranty" class="form-label fw-bold">Manufacturer’s Warranty Details</label>
									<textarea class="form-control ckeditor" name="warranty" id="warranty"></textarea>
								</div>
								<div class="mb-5">
									<label for="main_sch" class="form-label fw-bold">Recommended Maintenance Schedule</label>
									<textarea class="form-control ckeditor" name="main_sch" id="main_sch"></textarea>
								</div>
								<div class="mb-5">
									<label for="additional_info" class="form-label fw-bold">Additional Information</label>
									<textarea class="form-control ckeditor" name="additional_info" id="additional_info"></textarea>
								</div>
								<div class="mt-4">
		                        	<button class="btn btn-primary" type="submit">Update car</button>
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
		$car_category 		= $_POST['car_category'];
		$car_brand 			= $_POST['car_brand'];
		$car_description 	= $_POST['car_description'];
		$car_make			= $_POST['car_make'];
		$model 			 	= $_POST['model'];
		$year		 	 	= $_POST['year'];
		$trim_lvl 		 	= $_POST['trim_lvl'];
		$Engine  		 	= $_POST['Engine'];
		$hp					= $_POST['hp'];
		$transmission		= $_POST['transmission'];
		$drivetrain			= $_POST['drivetrain'];
		$fuel 				= $_POST['fuel'];
		$dimensions			= $_POST['dimensions'];
		$curb_weight		= $_POST['curb_weight'];
		$cargo_capacity		= $_POST['cargo_capacity'];
		$speed				= $_POST['speed'];
		$top_speed			= $_POST['top_speed'];
		$breaking_d			= $_POST['breaking_d'];
		$fuel_eff			= $_POST['fuel_eff'];
		$interior			= $_POST['interior'];
		$Infotainment		= $_POST['Infotainment'];
		$Safety				= $_POST['Safety'];
		$Exterior			= $_POST['Exterior'];
		$base_price			= $_POST['base_price'];
		$diff_price			= $_POST['diff_price'];
		$exp_rev			= $_POST['exp_rev'];
		$cust_rev			= $_POST['cust_rev'];
		$rating				= $_POST['rating'];
		$warranty			= $_POST['warranty'];
		$main_sch			= $_POST['main_sch'];
		$additional_info	= $_POST['additional_info'];		
		$file_type1 		= $_FILES['car_image']['type'];
		$file_tmp1 			= $_FILES['car_image']['tmp_name'];
		$file_nm1 			= $_FILES['car_image']['name'];
		$file_nm1 			= str_replace(" ","-",$file_nm1);
		if($file_nm1){
			$mimetype = @mime_content_type($_FILES['car_image']['tmp_name']);
			if(in_array($mimetype, array('image/jpeg', 'image/JPEG', 'image/JPG', 'image/jpg', 'image/gif', 'image/png', 'image/PNG')))
			{
				$folder1 = "Add Car/";
				$img_filename1 = $folder1.time().$file_nm1;
				$car_image = time().$file_nm1;
				move_uploaded_file($file_tmp1,$img_filename1);
			} else {
				$car_image = '';
			}
		} else {
			$car_image = '';
		}
		
	$uploaded_images = array();
if (isset($_FILES['car_detail_img']) && is_array($_FILES['car_detail_img']['name'])) {
    $car_detail_img = '';
    foreach($_FILES['car_detail_img']['name'] as $key => $value) {
        $file_type = $_FILES['car_detail_img']['type'][$key];
        $file_tmp = $_FILES['car_detail_img']['tmp_name'][$key];
        $file_nm = $_FILES['car_detail_img']['name'][$key];
        $file_nm = str_replace(" ", "-", $file_nm);

        if($file_nm) {
            $mimetype = @mime_content_type($_FILES['car_detail_img']['tmp_name'][$key]);
            if(in_array($mimetype, array('image/jpeg', 'image/jpg', 'image/gif', 'image/png'))) {
                $folder = "Add Car/";
                $img_filename = $folder. time(). $file_nm;
                $car_images = time(). $file_nm;
                move_uploaded_file($_FILES['car_detail_img']['tmp_name'][$key], $img_filename);
                $car_detail_img.= ($car_detail_img? ',' : ''). $car_images;
            }
        }
    }
} else {
    $car_detail_img = '';
}
		
		$sql_insert = "INSERT into categories SET 
			`car_name` = '".$car_name."', 
			`car_category` = '".$car_category."', 
			`car_brand` = '".$car_brand."', 
			`car_description` = '".$car_description."', 
			`car_image` = '".$car_image."', 
			`car_make` = '".$car_make."', 
			`model` = '".$model."', 
			`year` = '".$year."', 
			`trim_lvl` = '".$trim_lvl."', 
			`Engine` = '".$Engine."', 
			`hp` = '".$hp."', 
			`transmission` = '".$transmission."', 
			`drivetrain` = '".$drivetrain."', 
			`fuel` = '".$fuel."', 
			`dimensions` = '".$dimensions."', 
			`curb_weight` = '".$curb_weight."', 
			`cargo_capacity` = '".$cargo_capacity."', 
			`speed` = '".$speed."', 
			`top_speed` = '".$top_speed."', 
			`breaking_d` = '".$breaking_d."', 
			`fuel_eff` = '".$fuel_eff."', 
			`interior` = '".$interior."', 
			`Infotainment` = '".$Infotainment."', 
			`Safety` = '".$Safety."', 
			`Exterior` = '".$Exterior."', 
			`base_price` = '".$base_price."', 
			`diff_price` = '".$diff_price."', 
			`exp_rev` = '".$exp_rev."', 
			`cust_rev` = '".$cust_rev."', 
			`rating` = '".$rating."', 
			`warranty` = '".$warranty."', 
			`main_sch` = '".$main_sch."', 
			`additional_info` = '".$additional_info."', 
			`car_detail_img` = '".$car_detail_img."'";
		
		$result = mysqli_query($conn,$sql_insert);
		echo "<script>alert('Row inserted successfully.'); window.location.href='add_car.php';</script>";
	}?>

	<?php
if ($page == 'edit') {
    $edit_id = $_GET['edit_id'];
    $sql_select = "SELECT * FROM categories WHERE id = '$edit_id'";
    $result_add_car = mysqli_query($conn, $sql_select);
    $row_add_car = mysqli_fetch_assoc($result_add_car);
    $car_name = $row_add_car['car_name'];
    $car_category = $row_add_car['car_category'];
    $car_brand = $row_add_car['car_brand'];
    $car_description = $row_add_car['car_description'];
    $car_image = $row_add_car['car_image'];
    $car_detail_img = explode(',', $row_add_car['car_detail_img']);
    $car_make = $row_add_car['car_make'];
    $model = $row_add_car['model'];
    $year = $row_add_car['year'];
    $trim_lvl = $row_add_car['trim_lvl'];
    $Engine = $row_add_car['Engine'];
    $hp = $row_add_car['hp'];
    $transmission = $row_add_car['transmission'];
    $drivetrain = $row_add_car['drivetrain'];
    $fuel = $row_add_car['fuel'];
    $dimensions = $row_add_car['dimensions'];
    $curb_weight = $row_add_car['curb_weight'];
    $cargo_capacity = $row_add_car['cargo_capacity'];
    $speed = $row_add_car['speed'];
    $top_speed = $row_add_car['top_speed'];
    $breaking_d = $row_add_car['breaking_d'];
    $fuel_eff = $row_add_car['fuel_eff'];
    $interior = $row_add_car['interior'];
    $Infotainment = $row_add_car['Infotainment'];
    $Safety = $row_add_car['Safety'];
    $Exterior = $row_add_car['Exterior'];
    $base_price = $row_add_car['base_price'];
    $diff_price = $row_add_car['diff_price'];
    $exp_rev = $row_add_car['exp_rev'];
    $cust_rev = $row_add_car['cust_rev'];
    $rating = $row_add_car['rating'];
    $warranty = $row_add_car['warranty'];
    $main_sch = $row_add_car['main_sch'];
    $additional_info = $row_add_car['additional_info'];
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
                        <li class="breadcrumb-item"><a href="add_car.php">Add Car</a></li>
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
                        <form class="needs-validation" method="post" action="add_car.php?page=update" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="car_name" class="form-label fw-bold">Car Name</label>
                                <input type="text" class="form-control" name="car_name" value="<?php echo $car_name; ?>" required>
                                <input type="hidden" class="form-control" name="edit_id" id="edit_id" value="<?php echo $edit_id; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="car_category" class="form-label fw-bold">Car Category</label>
                                <select id="car_category" name="car_category" class="form-control" required>
                                    <option value="">Select an option</option>
                                    <option value="Hatchback" <?php if($car_category == 'Hatchback'){ echo 'selected'; } ?>>Hatchback</option>
                                    <option value="Coupe" <?php if($car_category == 'Coupe'){ echo 'selected'; } ?>>Coupe</option>
                                    <option value="Crossover" <?php if($car_category == 'Crossover'){ echo 'selected'; } ?>>Crossover</option>
                                    <option value="MPV" <?php if($car_category == 'MPV'){ echo 'selected'; } ?>>MPV</option>
                                    <option value="SUV" <?php if($car_category == 'SUV'){ echo 'selected'; } ?>>SUV</option>
                                    <option value="Convertible" <?php if($car_category == 'Convertible'){ echo 'selected'; } ?>>Convertible</option>
                                    <option value="Sedan" <?php if($car_category == 'Sedan'){ echo 'selected'; } ?>>Sedan</option>
                                    <option value="Sports" <?php if($car_category == 'Sports'){ echo 'selected'; } ?>>Sports</option>
                                    <option value="Premium/Luxury" <?php if($car_category == 'Premium/Luxury'){ echo 'selected'; } ?>>Premium/Luxury</option>
                                    <option value="Jeep" <?php if($car_category == 'Jeep'){ echo 'selected'; } ?>>Jeep</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="car_brand" class="form-label fw-bold">Car Brand</label>
                                <select id="car_brand" name="car_brand" class="form-control" required>
                                    <option value="">Select an option</option>
                                    <option value="Acura" <?php if($car_brand == 'Acura'){ echo 'selected'; } ?>>Acura</option>
                                    <option value="Alfa-Romeo" <?php if($car_brand == 'Alfa-Romeo'){ echo 'selected'; } ?>>Alfa-Romeo</option>
                                    <option value="AM-General" <?php if($car_brand == 'AM-General'){ echo 'selected'; } ?>>AM-General</option>
                                  <option value="Aston-Martin"<?php if($car_brand == 'Aston-Martin'){ echo 'selected'; } ?>>Aston-Martin</option>
                                  <option value="Audi"<?php if($car_brand == 'Audi'){ echo 'selected'; } ?>>Audi</option>
                                  <option value="Bentley"<?php if($car_brand == 'Bentley'){ echo 'selected'; } ?>>Bentley</option>
                                  <option value="BMW"<?php if($car_brand == 'BMW'){ echo 'selected'; } ?>>BMW</option>
                                  <option value="Buick"<?php if($car_brand == 'Buick'){ echo 'selected'; } ?>>Buick</option>
                                  <option value="Cadillac"<?php if($car_brand == 'Cadillac'){ echo 'selected'; } ?>>Cadillac</option>
                                  <option value="Chevrolet"<?php if($car_brand == 'Chevrolet'){ echo 'selected'; } ?>>Chevrolet</option>
                                  <option value="Chrysler"<?php if($car_brand == 'Chrysler'){ echo 'selected'; } ?>>Chrysler</option>
                                  <option value="Dodge"<?php if($car_brand == 'Dodge'){ echo 'selected'; } ?>>Dodge</option>
                                  <option value="Ferrari"<?php if($car_brand == 'Ferrari'){ echo 'selected'; } ?>>Ferrari</option>
                                  <option value="Fiat"<?php if($car_brand == 'Fiat'){ echo 'selected'; } ?>>Fiat</option>
                                  <option value="Ford"<?php if($car_brand == 'Ford'){ echo 'selected'; } ?>>Ford</option>
                                  <option value="Freightliner"<?php if($car_brand == 'Freightliner'){ echo 'selected'; } ?>>Freightliner</option>
                                  <option value="Genesis"<?php if($car_brand == 'Genesis'){ echo 'selected'; } ?>>Genesis</option>
                                  <option value="GMC"<?php if($car_brand == 'GMC'){ echo 'selected'; } ?>>GMC</option>
                                  <option value="Honda"<?php if($car_brand == 'Honda'){ echo 'selected'; } ?>>Honda</option>
                                  <option value="Hummer"<?php if($car_brand == 'Hummer'){ echo 'selected'; } ?>>Hummer</option>
                                  <option value="Hyundai"<?php if($car_brand == 'Hyundai'){ echo 'selected'; } ?>>Hyundai</option>
                                  <option value="Infiniti"<?php if($car_brand == 'Infiniti'){ echo 'selected'; } ?>>Infiniti</option>
                                  <option value="Isuzu"<?php if($car_brand == 'Isuzu'){ echo 'selected'; } ?>>Isuzu</option>
                                  <option value="Jaguar"<?php if($car_brand == 'Jaguar'){ echo 'selected'; } ?>>Jaguar</option>
                                  <option value="Jeep"<?php if($car_brand == 'Jeep'){ echo 'selected'; } ?>>Jeep</option>
                                  <option value="Kia"<?php if($car_brand == 'Kia'){ echo 'selected'; } ?>>Kia</option>
                                  <option value="Lamborghini"<?php if($car_brand == 'Lamborghini'){ echo 'selected'; } ?>>Lamborghini</option>
                                  <option value="Land-Rover"<?php if($car_brand == 'Land-Rover'){ echo 'selected'; } ?>>Land-Rover</option>
                                  <option value="Lexus"<?php if($car_brand == 'Lexus'){ echo 'selected'; } ?>>Lexus</option>
                                  <option value="Lincoln"<?php if($car_brand == 'Lincoln'){ echo 'selected'; } ?>>Lincoln</option>
                                  <option value="Lotus"<?php if($car_brand == 'Lotus'){ echo 'selected'; } ?>>Lotus</option>
                                  <option value="Maserati"<?php if($car_brand == 'Maserati'){ echo 'selected'; } ?>>Maserati</option>
                                  <option value="Maybach"<?php if($car_brand == 'Maybach'){ echo 'selected'; } ?>>Maybach</option>
                                  <option value="Mazda"<?php if($car_brand == 'Mazda'){ echo 'selected'; } ?>>Mazda</option>
                                  <option value="McLaren"<?php if($car_brand == 'McLaren'){ echo 'selected'; } ?>>McLaren</option>
                                  <option value="Mercedes-Benz"<?php if($car_brand == 'Mercedes-Benz'){ echo 'selected'; } ?>>Mercedes-Benz</option>
                                  <option value="Mercury"<?php if($car_brand == 'Mercury'){ echo 'selected'; } ?>>Mercury</option>
                                  <option value="Mini"<?php if($car_brand == 'Mini'){ echo 'selected'; } ?>>Mini</option>
                                  <option value="Mitsubishi"<?php if($car_brand == 'Mitsubishi'){ echo 'selected'; } ?>>Mitsubishi</option>
                                  <option value="Nissan"<?php if($car_brand == 'Nissan'){ echo 'selected'; } ?>>Nissan</option>
                                  <option value="Pontiac"<?php if($car_brand == 'Pontiac'){ echo 'selected'; } ?>>Pontiac</option>
                                  <option value="Porsche"<?php if($car_brand == 'Porsche'){ echo 'selected'; } ?>>Porsche</option>
                                  <option value="RAM"<?php if($car_brand == 'RAM'){ echo 'selected'; } ?>>RAM</option>
                                  <option value="Rolls-Royce"<?php if($car_brand == 'Rolls-Royce'){ echo 'selected'; } ?>>Rolls-Royce</option>
                                  <option value="Saab"<?php if($car_brand == 'Saab'){ echo 'selected'; } ?>>Saab</option>
                                  <option value="Saturn"<?php if($car_brand == 'Saturn'){ echo 'selected'; } ?>>Saturn</option>
                                  <option value="Scion"<?php if($car_brand == 'Scion'){ echo 'selected'; } ?>>Scion</option>
                                  <option value="Smart"<?php if($car_brand == 'Smart'){ echo 'selected'; } ?>>Smart</option>
                                  <option value="Subaru"<?php if($car_brand == 'Subaru'){ echo 'selected'; } ?>>Subaru</option>
                                  <option value="Suzuki"<?php if($car_brand == 'Suzuki'){ echo 'selected'; } ?>>Suzuki</option>
                                  <option value="Tesla"<?php if($car_brand == 'Tesla'){ echo 'selected'; } ?>>Tesla</option>
                                  <option value="Toyota"<?php if($car_brand == 'Toyota'){ echo 'selected'; } ?>>Toyota</option>
                                  <option value="Volkswagen"<?php if($car_brand == 'Volkswagen'){ echo 'selected'; } ?>>Volkswagen</option>
                                  <option value="Volvo"<?php if($car_brand == 'Volvo'){ echo 'selected'; } ?>>Volvo</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="car_description" class="form-label fw-bold">Car Description</label>
                                <textarea class="form-control ckeditor" name="car_description" id="car_description"><?php echo $car_description; ?></textarea>
                            </div>
                            <div class="mb-3">
							    <label for="car_image" class="form-label fw-bold">Car Image</label>
							    <input type="file" class="form-control" name="car_image">
							    <input type="hidden" name="current_car_image" value="<?php echo $car_image; ?>">
							    <?php if ($car_image) { ?>
							        <img src="Add Car/<?php echo $car_image; ?>" alt="Car Image" width="100">
							        <button type="button" class="btn btn-danger" onclick="deleteImage('<?php echo $car_image; ?>', 'single')">Delete</button>
							    <?php } ?>
							</div>
							<div class="mb-3">
							    <label for="car_detail_img" class="form-label fw-bold">Car Detail Image</label>
							    <input type="file" class="form-control" name="car_detail_img[]" multiple>
							    <input type="hidden" name="current_car_detail_img" value="<?php echo implode(',', $car_detail_img); ?>">
							    <?php if ($car_detail_img) { 
							        foreach ($car_detail_img as $img) {
							            echo '<img src="Add Car/' . $img . '" alt="Car Detail Image" width="100">';
							            echo '<button type="button" class="btn btn-danger" onclick="deleteImage(\'' . $img . '\', \'multiple\')">Delete</button><br>';
							        }
							    } ?>
							</div>
                            <div class="mb-3">
                                <label for="car_make" class="form-label fw-bold">Car Make Name</label>
                                <textarea class="form-control ckeditor" name="car_make" id="car_make"><?php echo $car_make; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="model" class="form-label fw-bold">Car Model Name</label>
                                <textarea class="form-control ckeditor" name="model" id="model"><?php echo $model; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="year" class="form-label fw-bold">Car Launch Date</label>
                                <input type="date" class="form-control" name="year" id="year" value="<?php echo $year; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="trim_lvl" class="form-label fw-bold">Trim Level</label>
                                <textarea class="form-control ckeditor" name="trim_lvl" id="trim_lvl"><?php echo $trim_lvl; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="Engine" class="form-label fw-bold">Engine Type and Displacement</label>
                                <textarea class="form-control ckeditor" name="Engine" id="Engine"><?php echo $Engine; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="hp" class="form-label fw-bold">Horsepower and Torque</label>
                                <textarea class="form-control ckeditor" name="hp" id="hp"><?php echo $hp; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="transmission" class="form-label fw-bold">Transmission Type</label>
                                <textarea class="form-control ckeditor" name="transmission" id="transmission"><?php echo $transmission; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="drivetrain" class="form-label fw-bold">Drivetrain Type</label>
                                <textarea class="form-control ckeditor" name="drivetrain" id="drivetrain"><?php echo $drivetrain; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="fuel" class="form-label fw-bold">Fuel Type</label>
                                <textarea class="form-control ckeditor" name="fuel" id="fuel"><?php echo $fuel; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="dimensions" class="form-label fw-bold">Dimensions (Length, Width, Height)</label>
                                <textarea class="form-control ckeditor" name="dimensions" id="dimensions"><?php echo $dimensions; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="curb_weight" class="form-label fw-bold">Curb Weight</label>
                                <textarea class="form-control ckeditor" name="curb_weight" id="curb_weight"><?php echo $curb_weight; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="cargo_capacity" class="form-label fw-bold">Cargo Capacity</label>
                                <textarea class="form-control ckeditor" name="cargo_capacity" id="cargo_capacity"><?php echo $cargo_capacity; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="speed" class="form-label fw-bold">Top Speed</label>
                                <textarea class="form-control ckeditor" name="speed" id="speed"><?php echo $speed; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="top_speed" class="form-label fw-bold">Top Speed</label>
                                <textarea class="form-control ckeditor" name="top_speed" id="top_speed"><?php echo $top_speed; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="breaking_d" class="form-label fw-bold">Breaking Distance</label>
                                <textarea class="form-control ckeditor" name="breaking_d" id="breaking_d"><?php echo $breaking_d; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="fuel_eff" class="form-label fw-bold">Fuel Efficiency</label>
                                <textarea class="form-control ckeditor" name="fuel_eff" id="fuel_eff"><?php echo $fuel_eff; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="interior" class="form-label fw-bold">Interior and Comfort Features</label>
                                <textarea class="form-control ckeditor" name="interior" id="interior"><?php echo $interior; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="Infotainment" class="form-label fw-bold">Infotainment and Connectivity</label>
                                <textarea class="form-control ckeditor" name="Infotainment" id="Infotainment"><?php echo $Infotainment; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="Safety" class="form-label fw-bold">Safety and Security</label>
                                <textarea class="form-control ckeditor" name="Safety" id="Safety"><?php echo $Safety; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="Exterior" class="form-label fw-bold">Exterior Features</label>
                                <textarea class="form-control ckeditor" name="Exterior" id="Exterior"><?php echo $Exterior; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="base_price" class="form-label fw-bold">Base Price</label>
                                <input type="text" class="form-control" name="base_price" value="<?php echo $base_price; ?>" >
                            </div>
                            <div class="mb-3">
                                <label for="diff_price" class="form-label fw-bold">Differences in Prices</label>
                                <textarea class="form-control ckeditor" name="diff_price" id="diff_price"><?php echo $diff_price; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exp_rev" class="form-label fw-bold">Expert Reviews</label>
                                <textarea class="form-control ckeditor" name="exp_rev" id="exp_rev"><?php echo $exp_rev; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="cust_rev" class="form-label fw-bold">Customer Reviews</label>
                                <textarea class="form-control ckeditor" name="cust_rev" id="cust_rev"><?php echo $cust_rev; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="rating" class="form-label fw-bold">Rating</label>
                                <textarea class="form-control ckeditor" name="rating" id="rating"><?php echo $rating; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="warranty" class="form-label fw-bold">Warranty Information</label>
                                <textarea class="form-control ckeditor" name="warranty" id="warranty"><?php echo $warranty; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="main_sch" class="form-label fw-bold">Maintenance Schedule</label>
                                <textarea class="form-control ckeditor" name="main_sch" id="main_sch"><?php echo $main_sch; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="additional_info" class="form-label fw-bold">Additional Information</label>
                                <textarea class="form-control ckeditor" name="additional_info" id="additional_info"><?php echo $additional_info; ?></textarea>
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
    $car_category = $_POST['car_category'];
    $car_brand = $_POST['car_brand'];
    $car_description = $_POST['car_description'];
    $car_make = $_POST['car_make'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $trim_lvl = $_POST['trim_lvl'];
    $Engine = $_POST['Engine'];
    $hp = $_POST['hp'];
    $transmission = $_POST['transmission'];
    $drivetrain = $_POST['drivetrain'];
    $fuel = $_POST['fuel'];
    $dimensions = $_POST['dimensions'];
    $curb_weight = $_POST['curb_weight'];
    $cargo_capacity = $_POST['cargo_capacity'];
    $speed = $_POST['speed'];
    $top_speed = $_POST['top_speed'];
    $breaking_d = $_POST['breaking_d'];
    $fuel_eff = $_POST['fuel_eff'];
    $interior = $_POST['interior'];
    $Infotainment = $_POST['Infotainment'];
    $Safety = $_POST['Safety'];
    $Exterior = $_POST['Exterior'];
    $base_price = $_POST['base_price'];
    $diff_price = $_POST['diff_price'];
    $exp_rev = $_POST['exp_rev'];
    $cust_rev = $_POST['cust_rev'];
    $rating = $_POST['rating'];
    $warranty = $_POST['warranty'];
    $main_sch = $_POST['main_sch'];
    $additional_info = $_POST['additional_info'];

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
            $folder1 = "Add Car/";
            $img_filename1 = $folder1.time().$file_nm1;
            $car_image = time().$file_nm1;
            move_uploaded_file($file_tmp1, $img_filename1);
        }
    }
} else {
    $sql_get_imagess = "SELECT car_image FROM categories WHERE id = '$edit_id'";
    $result_get_imagess = mysqli_query($conn, $sql_get_imagess);
    $row_get_imagess = mysqli_fetch_assoc($result_get_imagess);
    $car_image = $row_get_imagess['car_image'];
}

// Retrieve existing car detail images from database
$car_detail_img = '';
if (isset($_FILES['car_detail_img']) && is_array($_FILES['car_detail_img']['name'])) {
    $new_images = array();
    foreach ($_FILES['car_detail_img']['name'] as $key => $value) {
        $file_type = $_FILES['car_detail_img']['type'][$key];
        $file_tmp = $_FILES['car_detail_img']['tmp_name'][$key];
        $file_nm = $_FILES['car_detail_img']['name'][$key];
        $file_nm = str_replace(" ", "-", $file_nm);

        if ($file_nm) {
            $mimetype = @mime_content_type($_FILES['car_detail_img']['tmp_name'][$key]);
            if (in_array($mimetype, array('image/jpeg', 'image/jpg', 'image/gif', 'image/png'))) {
                $folder = "Add Car/";
                $img_filename = $folder.time().$file_nm;
                $car_images = time().$file_nm;
                move_uploaded_file($_FILES['car_detail_img']['tmp_name'][$key], $img_filename);
                $new_images[] = $car_images;
            }
        }
    }

// Get existing images from database
$sql_get_images = "SELECT car_detail_img FROM categories WHERE id = '$edit_id'";
$result_get_images = mysqli_query($conn, $sql_get_images);
$row_get_images = mysqli_fetch_assoc($result_get_images);
$existing_images = explode(',', $row_get_images['car_detail_img']);

// Merge existing images with new images
if ($new_images) {
    if ($existing_images) {
        $car_detail_img = $row_get_images['car_detail_img'] . ',' . implode(',', $new_images);
    } else {
        $car_detail_img = implode(',', $new_images);
    }
} else {
    // If no new images are uploaded, use the existing images
    $car_detail_img = $row_get_images['car_detail_img'];
}}

// Update the database
$sql_update = "UPDATE categories SET 
    `car_name` = '".$car_name."', 
    `car_category` = '".$car_category."', 
    `car_brand` = '".$car_brand."', 
    `car_description` = '".$car_description."', 
    `car_image` = '".$car_image."', 
    `car_make` = '".$car_make."', 
    `model` = '".$model."', 
    `year` = '".$year."', 
    `trim_lvl` = '".$trim_lvl."', 
    `Engine` = '".$Engine."', 
    `hp` = '".$hp."', 
    `transmission` = '".$transmission."', 
    `drivetrain` = '".$drivetrain."', 
    `fuel` = '".$fuel."', 
    `dimensions` = '".$dimensions."', 
    `curb_weight` = '".$curb_weight."', 
    `cargo_capacity` = '".$cargo_capacity."', 
    `speed` = '".$speed."', 
    `top_speed` = '".$top_speed."', 
    `breaking_d` = '".$breaking_d."', 
    `fuel_eff` = '".$fuel_eff."', 
    `interior` = '".$interior."', 
    `Infotainment` = '".$Infotainment."', 
    `Safety` = '".$Safety."', 
    `Exterior` = '".$Exterior."', 
    `base_price` = '".$base_price."', 
    `diff_price` = '".$diff_price."', 
    `exp_rev` = '".$exp_rev."', 
    `cust_rev` = '".$cust_rev."', 
    `rating` = '".$rating."', 
    `warranty` = '".$warranty."', 
    `main_sch` = '".$main_sch."', 
    `additional_info` = '".$additional_info."', 
    `car_detail_img` = '".mysqli_real_escape_string($conn, $car_detail_img)."' 
    WHERE id = '$edit_id'";
$result = mysqli_query($conn, $sql_update);
echo "<script>alert('Category Updated successfully.'); window.location.href='add_car.php';</script>";
}
?>

<!---delete -->
<?php if($page=='delete'){
	$delete_id = $_GET['delete_id'];
	$sql = "DELETE FROM categories WHERE id = '$delete_id'";
	$result_library = mysqli_query($conn,$sql);
	echo "<script>window.location.href='add_car.php'</script>";
}?>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<?php include('footer.php');?>


<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script>
  CKEDITOR.replace('editor', {
    height: 300,
    filebrowserUploadUrl: 'upload.php'
  });
</script>

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
            url: "delete_image.php",
            data: { image: imageName, type: imageType },
            success: function(response) {
                // Remove the image from the page
                $('img[src="Add Car/' + imageName + '"]').remove();
                $('button[onclick="deleteImage(\'' + imageName + '\', \'' + imageType + '\')"]').remove();
                alert(response);
            }
        });
    }
}
</script>
</body>