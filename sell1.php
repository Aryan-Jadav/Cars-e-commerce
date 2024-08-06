<?php
include 'header.php';
include 'admin/db.php';

if (isset($_POST['submit'])) {
    // Get the form values
    $name           = mysqli_real_escape_string($conn, $_POST['name']);
    $phone_no       = mysqli_real_escape_string($conn, $_POST['phone_no']);
    $country        = mysqli_real_escape_string($conn, $_POST['country']);
    $state          = mysqli_real_escape_string($conn, $_POST['state']);
    $city           = mysqli_real_escape_string($conn, $_POST['city']);
    $address        = mysqli_real_escape_string($conn, $_POST['address']);
    $car_brand      = mysqli_real_escape_string($conn, $_POST['car_brand']);
    $car_name       = mysqli_real_escape_string($conn, $_POST['car_name']);
    $car_mod_no     = mysqli_real_escape_string($conn, $_POST['car_mod_no']);
    $car_no         = mysqli_real_escape_string($conn, $_POST['car_no']);
    $km_driven      = mysqli_real_escape_string($conn, $_POST['km_driven']);
    $dents          = mysqli_real_escape_string($conn, $_POST['dents']);
    $min_sale_price = mysqli_real_escape_string($conn, $_POST['min_sale_price']);
    $max_sale_price = mysqli_real_escape_string($conn, $_POST['max_sale_price']);

    // Check if images are uploaded
    if (isset($_FILES['images']) && count($_FILES['images']['name']) > 0) {
        $image_names = array();
        foreach ($_FILES['images']['name'] as $key => $value) {
            $file_tmp = $_FILES['images']['tmp_name'][$key];
            $file_nm = $_FILES['images']['name'][$key];
            $file_nm = str_replace(" ", "-", $file_nm);
            $mimetype = mime_content_type($file_tmp);
            if (in_array($mimetype, array('image/jpeg', 'image/JPEG', 'image/JPG', 'image/jpg', 'image/gif', 'image/png', 'image/PNG'))) {
                $folder = __DIR__. '/admin/assets/Images/uploaded_images/';
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }
                $timestamp = time(); // get the current timestamp
                $img_filename = $folder. $timestamp. '_'. $file_nm;
                $image_names[] = basename($img_filename);
                move_uploaded_file($file_tmp, $img_filename);
            }
        }
        $image_string = implode(',', $image_names);
        // Insert data into the database
        $sql_insert = "INSERT into selling (name, phone_no, country, state, city, address, car_brand, car_name, car_mod_no, car_no, km_driven, dents, min_sale_price, max_sale_price, image) 
        VALUES ('$name', '$phone_no', '$country', '$state', '$city', '$address', '$car_brand', '$car_name', '$car_mod_no', '$car_no', '$km_driven', '$dents', '$min_sale_price', '$max_sale_price', '$image_string')";
        $result = mysqli_query($conn, $sql_insert);

        if ($result) {
            echo "<script>alert('Data is successfully inserted'); window.location.href='sell1.php';</script>";
        } else {
            echo "<script>alert('Error inserting data'); window.location.href='sell1.php';</script>";
        }
    } else {
        echo "<script>alert('No files uploaded'); window.location.href='sell1.php';</script>";
    }
}
?>
<main>
    <section id="main-carousel">
        <div class="container-fluid">
          <div class="row">
            <div class="col px-0">
              <div class="carousel slide kb-carousel carousel-fade" id="carouselKenBurns" data-bs-ride="carousel">
                <!-- Carousel Items -->
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="assets\Images\selling-page-carousel1.jpg" class="d-block w-100" alt="Slide 1">
                    <div class="carousel-caption kb-caption kb-caption-center">
                      <h1 data-animation="animated">Hassle-Free Selling Process</h1>
                      <h3 data-animation="animated">AJ's FastLane takes care of everything, from marketing to negotiation, so you can sit back and relax.</h3>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img src="assets\Images\selling-page-carousel2.jpg" class="d-block w-100" alt="Slide 2">
                    <div class="carousel-caption kb-caption kb-caption-center">
                      <h1 data-animation="animated">Maximize Your Car's Value</h1>
                      <h3 data-animation="animated">Get top dollar for your vehicle by partnering with the nation's premier classic car dealership.</h3>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img src="assets\Images\selling-page-carousel3.jpg" class="d-block w-100" alt="Slide 3">
                    <div class="carousel-caption kb-caption kb-caption-center">
                      <h1 data-animation="animated">Sell Quickly and Conveniently</h1>
                      <h3 data-animation="animated">With AJ's FastLane, you can sell your car fast and hassle-free.</h3>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img src="assets\Images\selling-page-carousel4.jpg" class="d-block w-100" alt="Slide 3">
                    <div class="carousel-caption kb-caption kb-caption-center">
                      <h1 data-animation="animated">Expertise in Classic Cars</h1>
                      <h3 data-animation="animated">We stay up-to-date on the latest trends, values, and collector preferences to ensure you get the best price.</h3>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img src="assets\Images\selling-page-carousel5.jpeg" class="d-block w-100" alt="Slide 3">
                    <div class="carousel-caption kb-caption kb-caption-center">
                      <h1 data-animation="animated">Sell Your Late-Model Vehicle</h1>
                      <h3 data-animation="animated">AJ's FastLane isn't just for classic cars - we also buy and sell late-model luxury, sports cars, and trucks</h3>
                    </div>
                  </div>
                </div>

                <!-- Carousel Arrows -->
                <button class="carousel-control-prev kb-control-prev" type="button" data-bs-target="#carouselKenBurns" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next kb-control-next" type="button" data-bs-target="#carouselKenBurns" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </section>
    <div class="container">
        <h1>Enter Your Car Details:</h1>
    <form action="" method="POST" enctype="multipart/form-data">
      <label for="product-name">Your Name:</label>
      <input type="text" id="name" name="name" ><br><br>

      <label for="product-name">Your Phone no.:</label>
      <input type="number" id="phone_no" name="phone_no" ><br><br>

      <label for="product-name">Country:</label>
      <input type="text" id="country" name="country" ><br><br>

      <label for="product-name">State:</label>
      <input type="text" id="state" name="state" ><br><br>

      <label for="product-name">City:</label>
      <input type="text" id="city" name="city" ><br><br>

      <label for="product-description">Address:</label>
      <textarea id="address" name="address" rows="2" maxlength="300" ></textarea><br><br>

      <label for="product-name">Car Brand:</label>
      <input type="text" id="car_brand" name="car_brand" ><br><br>

      <label for="product-name">CarName:</label>
      <input type="text" id="car_name" name="car_name" ><br><br>

      <label for="product-name">Car Model No.:</label>
      <input type="text" id="car_mod_no" name="car_mod_no" ><br><br>

      <label for="product-name">Car No.:</label>
      <input type="text" id="car_no" name="car_no" ><br><br>

      <label for="product-name">Km Driven:</label>
      <input type="number" id="km_driven" name="km_driven" ><br><br>

      <label for="product-name">Dents:</label>
      <input type="text" id="dents" name="dents" ><br><br>

      <label for="product-name">Min Sale Price:</label>
      <input type="number" id="min_sale_price" name="min_sale_price" ><br><br>

      <label for="product-name">Max Sale Price:</label>
      <input type="number" id="max_sale_price" name="max_sale_price" ><br><br>

      <label for="product-name">Upload Images:</label>
      <input type="file" id="images" name="images[]" multiple ><br><br>

      <input type="submit" name="submit" value="Submit">
    </form>
    </div>
</main>
<?php
include 'footer.php';?>