<?php 
include ('header.php'); 
include 'admin/db.php';

// Retrieve the form data from the database
$limit = 12; // Number of cards to show per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page
$start = ($page - 1) * $limit; // Starting index for the current page

$stmt = $conn->prepare("SELECT * FROM buying LIMIT $start, $limit");
$stmt->execute();
$result = $stmt->get_result();

// Get the total number of rows
$stmt_total = $conn->prepare("SELECT COUNT(*) as total FROM buying");
$stmt_total->execute();
$result_total = $stmt_total->get_result();
$row_total = $result_total->fetch_assoc();
$total = $row_total['total'];

// Calculate the number of pages
$pages = ceil($total / $limit);
?>

<main>
    <!-- carousel start -->
        <section id="main-carousel">
        <div class="container-fluid">
          <div class="row">
            <div class="col px-0">
              <div class="carousel slide kb-carousel carousel-fade" id="carouselKenBurns" data-bs-ride="carousel">
                <!-- Carousel Items -->
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="assets\Images\buying-page-carousel1.jpg" class="d-block w-100" alt="Slide 1">
                    <div class="carousel-caption kb-caption kb-caption-center">
                      <h1 data-animation="animated">Discover Your Dream Car</h1>
                      <h3 data-animation="animated">Find the classic, luxury or late-model vehicle you've always wanted.</h3>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img src="assets\Images\buying-page-carousel2.jpg" class="d-block w-100" alt="Slide 2">
                    <div class="carousel-caption kb-caption kb-caption-center">
                      <h1 data-animation="animated">Buy with Confidence</h1>
                      <h3 data-animation="animated">Purchase your next vehicle with the peace of mind that comes from working with experts.</h3>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img src="assets\Images\buying-page-carousel3.jpg" class="d-block w-100" alt="Slide 3">
                    <div class="carousel-caption kb-caption kb-caption-center">
                      <h1 data-animation="animated">Convenient Buying Process</h1>
                      <h3 data-animation="animated">Enjoy a hassle-free, straightforward experience from start to finish.</h3>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img src="assets\Images\buying-page-carousel4.jpg" class="d-block w-100" alt="Slide 3">
                    <div class="carousel-caption kb-caption kb-caption-center">
                      <h1 data-animation="animated">Unparalleled Expertise </h1>
                      <h3 data-animation="animated">Trust the knowledge and experience of our classic car specialists.</h3>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img src="assets\Images\buying-page-carousel5.jpg" class="d-block w-100" alt="Slide 3">
                    <div class="carousel-caption kb-caption kb-caption-center">
                      <h1 data-animation="animated">Financing Options Available</h1>
                      <h3 data-animation="animated">Get the car you want with flexible financing tailored to your needs.</h3>
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
        <!-- carousel end-->
    <div class="container">
      <div class="buy-header">
        <h1>Want To Change Your Ride?</h1>
      </div>
        <div class="product-list">
      <?php while ($row = $result->fetch_assoc()) { ?>
      <div class="product" data-name="<?php echo $row["car_name"]; ?>" data-price="<?php echo $row["new_price"]; ?>">
        <div class="img">
          <img id="product-img" src="<?php echo 'admin/Sell Car/' . $row["car_image"]; ?>" alt="<?php echo $row["car_name"]; ?>">
        </div>
        <div class="info">
          <a id="product-info" href="">
            <h3 id="product-name"><?php echo $row["car_name"]; ?></h3>
          </a>
          <p id="prod-price-before">$<?php echo $row["og_price"]; ?></p><br>
          <p id="prod-price-after">New Price:$<?php echo $row["new_price"]; ?></p>
        </div>
        <div class="d-block">
          <button id="button-1" class="text-start">
            <a href="#" data-name="<?php echo $row["car_name"]; ?>" data-price="<?php echo $row["new_price"]; ?>" class="add-to-cart" style="color: white !important; text-decoration: none !important;">Add to cart</a>
          </button>
          <button id="button-2" class="text-end">
            <?php
            $car_name = strtolower($row["car_name"]); // Convert car name to lowercase
            $sql_check_car_name = "SELECT * FROM categories WHERE LOWER(car_name) = '$car_name'";
            $result_check_car_name = mysqli_query($conn, $sql_check_car_name);
            
            if (mysqli_num_rows($result_check_car_name) > 0) {
              $row_check_car_name = mysqli_fetch_assoc($result_check_car_name);
              $car_id = $row_check_car_name["id"];
              ?>
              <a id="product-info" href="sub_category.php?id=<?php echo $car_id; ?>">For more info</a>
              <?php
            } else {
              echo "No car found with the same name.";
            }
            ?>
          </button>
          <!-- <button id="button-2" class="text-end">
            <a id="product-info" href="sub_category.php?id=<?php echo $row["id"]; ?>">For more info</a>
          </button> -->
        </div>
      </div>
      <?php } ?>
    </div>           
  <nav aria-label="Page navigation example" style=" display: flex;
    justify-content: center;">
  <ul class="pagination">
    <?php if ($page > 1) { ?>
    <li class="page-item"><a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a></li>
    <?php } ?>
    <?php for ($i = 1; $i <= $pages; $i++) { ?>
    <li class="page-item <?php if ($i == $page) echo 'active'; ?>"><a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
    <?php } ?>
    <?php if ($page < $pages) { ?>
    <li class="page-item"><a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a></li>
    <?php } ?>
  </ul>
</nav>
 <!-- nav -->
    <nav class="navbar navbar-inverse bg-inverse fixed-top bg-faded">
      <div class="row">
          <div class="col">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cartModal">Cart (<span class="total-count"></span>)</button>
            <button class="clear-cart btn btn-danger">Clear Cart</button>
          </div>
      </div>
    </nav>
<!-- nav close -->
<!-- Modal -->
<div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="cartModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="display: flex; align-items: center; justify-content: space-between;">
        <h5 class="modal-title" id="cartModalLabel">Cart</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" 
          style="background: transparent; border: none; color: #000; font-size: 1.5rem; line-height: 1; padding: 0; cursor: pointer;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="show-cart table">
          <!-- Cart items will be dynamically generated here -->
        </table>
        <div>Total price: $<span class="total-cart"></span></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Order now</button>
      </div>
    </div>
  </div>
</div>
</main>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php include ('footer.php'); ?>