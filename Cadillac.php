<?php include 'header.php';?>
<main>
	<div class="container">
	<h1 id="Car-title"><strong>Cadillac Car Models</strong></h1>
  	<div class="row row-cols-1 row-cols-md-4 g-4">
  	<?php
  	$sql_about = "Select * from categories where car_brand = 'Cadillac' order by id desc";
  	$result_about = mysqli_query($conn, $sql_about);
  	while ($row_about = mysqli_fetch_assoc($result_about)) {
    	$car_image = $row_about['car_image'];
    	$car_name = $row_about['car_name'];
    	$car_description = $row_about['car_description'];
    	$car_brand = $row_about['car_brand'];
  	?>
  	<div class="col">
    	<div class="card">
      		<img src="admin/Add Car/<?php echo $car_image; ?>" class="card-img-top" alt="<?php echo $car_name; ?>" style="width: 100%; height: 250px;">
      		<div class="card-body">
       		<h5 class="card-title"><?php echo $car_name; ?></h5>
        	<p class="card-text"><?php echo $car_description; ?><a href="sub_category.php?id=">click here</a></p>
      		</div>
    	</div>
  	</div>
  <?php } ?>
	</div>
	</div>
</main>
<?php include 'footer.php';?>