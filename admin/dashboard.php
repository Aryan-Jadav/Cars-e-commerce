<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: index.php');
    exit;
}
include 'admin_nav.php';
?>
<!-- Rest of the dashboard code -->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin's Page</title>
	<link rel="stylesheet" type="text/css" href="assets\css\styles.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
	<h1 class="admin-welcome">Welcome To AJ's FastLane's Dashboard</h1>
	<div class="container">
		<div class="row row-cols-1 row-cols-md-3 g-4">
		<?php
		include 'db.php';
			$a = 1;
			$sql_selling = "Select count(id) as title from selling";
			$result_selling = mysqli_query($conn,$sql_selling);
			$selling_row = mysqli_fetch_assoc($result_selling);
			$title =$selling_row['title'];
			?>
			<div class="col">
				<div class="card" style="background-color: #00996f;">
				<div class="card-body">
					<a href="sell.php">
					<div class="card-title"style="color: #FFFFFF;">
						Total Cars for selling
					</div><br>
					<h2 class="card-text" style="color:#FFFFFF"><?php echo $title; ?></h2><br></a>
					<div class="progress" style="height: 0.5rem !important;">
  						<div class="progress-bar" role="progressbar" aria-label="Basic example" style="width: 20%;height: 0.5rem !important; background-color: #FFB04A;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
				</div>
				</div>
			</div>
		<?php
		include 'db.php';
			$a = 1;
			$sql_selling = "Select count(id) as title from query";
			$result_selling = mysqli_query($conn,$sql_selling);
			$selling_row = mysqli_fetch_assoc($result_selling);
			$title =$selling_row['title'];
			?>
			<div class="col">
				<div class="card" style="background-color: #F42F15;">
					<div class="card-body">
					<a href="queries.php">
					<div class="card-title" style="color: #F8F1F2;">
						Total Queries received
					</div><br>
					<h2 class="card-text" style="color: #FAFAFA"><?php echo $title; ?></h2><br></a>
					<div class="progress" style="height: 0.5rem !important;">
  						<div class="progress-bar" role="progressbar" aria-label="Basic example" style="width: 45%;height: 0.5rem !important; background-color: #FFB04A;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
				</div>
				</div>
			</div>
		<?php
		include 'db.php';
			$a = 1;
			$sql_selling = "Select count(id) as title from car_maintenance";
			$result_selling = mysqli_query($conn,$sql_selling);
			$selling_row = mysqli_fetch_assoc($result_selling);
			$title =$selling_row['title'];
			?>
			<div class="col">
				<div class="card" style="background-color: #7F27FF;">
				<div class="card-body">
					<a href="maintenance_req.php">
					<div class="card-title" style="color: #FFFFFF;">
						Total Car Maintenance Request Recived
					</div>
					<h2 class="card-text" style="color: #FFFFFF"><?php echo $title; ?></h2></a>
					<div class="progress" style="height: 0.5rem !important;">
  						<div class="progress-bar" role="progressbar" aria-label="Basic example" style="width: 30%;height: 0.5rem !important; background-color: #FFB04A;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
				</div>
				</div>
			</div>
		</div>
		</div>
		<div class="container">
	  	<div class="row">
	    	<div class="col-md-6">
	      	<div class="card" style="width: 635px; margin: auto;">
	        <img src="assets\Images\add_car.jpg" class="card-img-top" style="width:100%; height: 350px;">
	        <div class="card-body">
	          <div style="display: flex; justify-content: space-between; align-items: center;">
	            <h5 class="card-title">Want to add cars?</h5>
	            <a href="add_car.php" class="btn btn-primary">Add Car</a>
	          </div>
	        </div>
	      </div>
	    </div>
	    <div class="col-md-6">
	      	<div class="card" style="width: 635px; margin: auto;">
	        <img src="assets\Images\sell car.jpg" class="card-img-top" style="width:100%; height: 350px;">
	        <div class="card-body">
	          <div style="display: flex; justify-content: space-between; align-items: center;">
	            <h5 class="card-title">Want to Sell cars?</h5>
	            <a href="sell_car.php" class="btn btn-primary">Sell Car</a>
	          </div>
	        </div>
	      </div>
	    </div>
	    <div class="col-md-6" style="margin-top: 20px;">
	      	<div class="card" style="width: 635px; margin: auto;">
	        <img src="assets\Images\news.jpg" class="card-img-top" style="width:100%; height: 350px;">
	        <div class="card-body">
	          <div style="display: flex; justify-content: space-between; align-items: center;">
	            <h5 class="card-title">Add Latest News</h5>
	            <a href="add_news.php" class="btn btn-primary">Add news</a>
	          </div>
	        </div>
	      </div>
	    </div>
	    <div class="col-md-6" style="margin-top: 20px;">
	      	<div class="card" style="width: 635px; margin: auto;">
	        <img src="assets\Images\user.jpg" class="card-img-top" style="width:100%; height: 350px;">
	        <div class="card-body">
	          <div style="display: flex; justify-content: space-between; align-items: center;">
	            <h5 class="card-title">Want to see your user?</h5>
	            <a href="users.php" class="btn btn-primary">Users</a>
	          </div>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>
</div>
<?php include 'footer.php';?>
