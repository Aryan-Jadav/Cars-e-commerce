<?php
include 'header.php';
?>
<head>
  <style>
    th {
      border: 5px solid black; 
      color: black;
    }
    td {
      border: 5px solid black; 
      color: black;
    }
  </style>
</head>
<main>
  <div class="container">
    <h1 id="Car-title"><strong>Car Details</strong></h1>
    <?php
    include 'admin/db.php';

    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $sql_car_details = "SELECT * FROM categories WHERE id = '$id'";
      $result_car_details = mysqli_query($conn, $sql_car_details);
      
      if (mysqli_num_rows($result_car_details) > 0) {
        $row_car_details = mysqli_fetch_assoc($result_car_details);
        $car_name = $row_car_details['car_name'];
        $car_make = $row_car_details['car_make'];
        $model = $row_car_details['model'];
        $year = $row_car_details['year'];
        $trim_lvl = $row_car_details['trim_lvl'];
        $Engine = $row_car_details['Engine'];
        $hp = $row_car_details['hp'];
        $transmission = $row_car_details['transmission'];
        $drivetrain = $row_car_details['drivetrain'];
        $fuel = $row_car_details['fuel'];
        $dimensions = $row_car_details['dimensions'];
        $curb_weight = $row_car_details['curb_weight'];
        $cargo_capacity = $row_car_details['cargo_capacity'];
        $speed = $row_car_details['speed'];
        $top_speed = $row_car_details['top_speed'];
        $breaking_d = $row_car_details['breaking_d'];
        $fuel_eff = $row_car_details['fuel_eff'];
        $interior = $row_car_details['interior'];
        $Infotainment = $row_car_details['Infotainment'];
        $Safety = $row_car_details['Safety'];
        $Exterior = $row_car_details['Exterior'];
        $base_price = $row_car_details['base_price'];
        $diff_price = $row_car_details['diff_price'];
        $exp_rev = $row_car_details['exp_rev'];
        $cust_rev = $row_car_details['cust_rev'];
        $rating = $row_car_details['rating'];
        $warranty = $row_car_details['warranty'];
        $main_sch = $row_car_details['main_sch'];
        $additional_info = $row_car_details['additional_info'];

        // Split images into an array
        $image_urls = explode(',', $row_car_details['car_detail_img']);
     ?>
    <div class="row">
      <div class="col-md-12">
        <h2><?php echo $car_name;?></h2>
      </div>
    </div><br>
    <div class="row">
      <div class="col-md-12" style="margin-bottom: 20px;">
        <div id="gallery" class="photos-grid-container gallery" style="display: flex; flex-wrap: nowrap; justify-content: center;">
          <?php
          // Display main image
          if (!empty($image_urls[0])) {
          ?>
          <div class="main-photo img-box" style="width: 100%; height: 100%;">
            <a href="<?php echo 'admin/Add Car/'. $image_urls[0];?>" class="glightbox" data-glightbox="type: image">
              <img src="<?php echo 'admin/Add Car/'. $image_urls[0];?>" alt="<?php echo $car_name;?>" style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px;" />
            </a>
          </div>
          <?php } ?>
          <div class="sub" style="display: flex; flex-wrap: wrap; justify-content: center;">
            <?php
            // Display up to 6 additional images
            for ($i = 1; $i <= min(count($image_urls), 3); $i++) {
            ?>
            <div class="img-box" style="width: calc((100% - 50px) / 2); margin: 5px; border-radius: 10px; overflow: hidden;">
              <a href="<?php echo 'admin/Add Car/'. $image_urls[$i];?>" class="glightbox" data-glightbox="type: image">
                <img src="<?php echo 'admin/Add Car/'. $image_urls[$i];?>" alt="<?php echo $car_name;?>" style="width: 100%; height: 150px; object-fit: cover;" />
              </a>
            </div>
            <?php } ?>
            <?php
            // If more than 6 images, show "show more" link
            if (count($image_urls) > 4) {
            ?>
            <div id="multi-link" class="img-box show-more" style="width: calc((100% - 50px) / 2); margin: 5px; border-radius: 10px; overflow: hidden; position: relative;">
              <a href="<?php echo 'admin/Add Car/'. $image_urls[4];?>" class="glightbox" data-glightbox="type: image">
                <img src="<?php echo 'admin/Add Car/'. $image_urls[4];?>" alt="<?php echo $car_name;?>" style="width: 100%; height: 150px; object-fit: cover;" />
                <div class="transparent-box" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); display: flex; justify-content: center; align-items: center;">
                  <div class="caption" style="color: #fff; font-size: 24px; font-weight: bold;">
                    +<?php echo count($image_urls) - 4;?>
                  </div>
                </div>
              </a>
              <div class="more-images" style="display: none;">
                <?php
                // Display remaining images
                for ($j = 5; $j < count($image_urls); $j++) {
                ?>
                <a href="<?php echo 'admin/Add Car/'. $image_urls[$j];?>" class="glightbox" data-glightbox="type: image">
                  <img src="<?php echo 'admin/Add Car/'. $image_urls[$j];?>" alt="<?php echo $car_name;?>" style="width: 100%; height: 150px; object-fit: cover; margin: 5px;" />
                </a>
                <?php } ?>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <table class="car-details-table" style="border: 5px solid black;">
          <tr>
            <th>Car Make</th>
            <td><?php echo $car_make;?></td>
          </tr>
          <tr>
            <th>Car Model</th>
            <td><?php echo $model;?></td>
          </tr>
          <tr>
            <th>Car launch Date</th>
            <td><?php echo $year;?></td>
          </tr>
          <tr>
            <th>Trim Level</th>
            <td><?php echo $trim_lvl;?></td>
          </tr>          
          <tr>
            <th>Engine Type and Displacement</th>
            <td><?php echo $Engine;?></td>
          </tr>
          <tr>
            <th>Horsepower and Torque</th>
            <td><?php echo $hp;?></td>
          </tr>
          <tr>
            <th>Transmission Type</th>
            <td><?php echo $transmission;?></td>
          </tr>
          <tr>
            <th>Drivetrain</th>
            <td><?php echo $drivetrain;?></td>
          </tr>
          <tr>
            <th>Fuel Type and Fuel Economy</th>
            <td><?php echo $fuel;?></td>
          </tr>
          <tr>
            <th>Dimensions</th>
            <td><?php echo $dimensions;?></td>
          </tr>
          <tr>
            <th>Curb Weight</th>
            <td><?php echo $curb_weight;?></td>
          </tr>
          <tr>
            <th>Cargo Capacity</th>
            <td><?php echo $cargo_capacity;?></td>
          </tr><tr>
            <th>0-60 mph/ 0-100 kmph Time</th>
            <td><?php echo $speed;?></td>
          </tr>
          <tr>
            <th>Top Speed</th>
            <td><?php echo $top_speed;?></td>
          </tr>
          <tr>
            <th>Braking Distance</th>
            <td><?php echo $breaking_d;?></td>
          </tr>
          <tr>
            <th>Fuel Efficiency</th>
            <td><?php echo $fuel_eff;?></td>
          </tr>
          <tr>
            <th>Interior</th>
            <td><?php echo $interior;?></td>
          </tr>
          <tr>
            <th>Infotainment System</th>
            <td><?php echo $Infotainment;?></td>
          </tr>
          <tr>
            <th>Safety Features</th>
            <td><?php echo $Safety;?></td>
          </tr>
          <tr>
            <th>Exterior Features</th>
            <td><?php echo $Exterior;?></td>
          </tr>
          <tr>
            <th>Base Price</th>
            <td><?php echo $base_price;?></td>
          </tr>
          <tr>
            <th>Starting Price</th>
            <td><?php echo $diff_price;?></td>
          </tr>
          <tr>
            <th>Expert Reviews</th>
            <td><?php echo $exp_rev;?></td>
          </tr>
          <tr>
            <th>Customer Reviews</th>
            <td><?php echo $cust_rev;?></td>
          </tr>
          <tr>
            <th>Overall Rating</th>
            <td><?php echo $rating;?></td>
          </tr>
          <tr>
            <th>Warranty</th>
            <td><?php echo $warranty;?></td>
          </tr>
          <tr>
            <th>Maintenance Schedule</th>
            <td><?php echo $main_sch;?></td>
          </tr>
          <tr>
            <th>Additional Information</th>
            <td><?php echo $additional_info;?></td>
          </tr>
        </table>
      </div>
    </div>
    <div class="row" style="margin-top: 10px; margin-bottom: 20px;">
      <div class="col-md-12">
        <a href="<?php echo $_SERVER['HTTP_REFERER'];?>" class="btn btn-primary">Back</a>
      </div>
    </div>
    <?php
      } else {
        echo "No car details found.";
      }
    } else {
    ?>
      <p>No car details found.</p>
    <?php } ?>
  </div>
</main>
<!-- Include FancyBox JS -->
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.1.0/dist/fancybox.umd.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  // Initialize Fancybox for existing images
  Fancybox.bind("[data-glightbox='type: image']", {
    // Options can go here
  });

  // Show more images handling
  $(document).ready(function() {
    $(".show-more").click(function(event) {
      event.preventDefault(); // Prevent default anchor behavior

      var $this = $(this);
      var images = [];
      var currentIndex = 6; // Start from the 7th image (index 6)

      // Get all images in the gallery
      $this.parents(".gallery").find("a.glightbox").each(function(index) {
        images.push({
          'src': $(this).attr("href"),
          'type': 'image',
          'caption': '<?php echo $car_name; ?>' // Adjust caption as needed
        });
      });

      // Open Fancybox programmatically starting from the 7th image
      Fancybox.show(images, {
        'loop': true, // Enable looping through images
        'startIndex': currentIndex // Open from the current image index
      });
    });
  });
});


</script>
<?php include 'footer.php';?>
