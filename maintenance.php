<?php
include 'header.php';
include 'admin/db.php';

if (isset($_POST['submit'])) {
    $required_fields = array('name', 'phone', 'email', 'address', 'make', 'model', 'year', 'vin', 'license', 'lastServiceDate', 'previousRecords', 'lastMileage', 'currentMileage', 'knownIssues', 'serviceType', 'serviceDate', 'serviceTime', 'serviceLocation', 'specificRequests', 'paymentMethod');
    $errors = array();

    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[] = $field;
        }
    }

    if (empty($errors)) {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO car_maintenance (name, phone, email, address, make, model, year, vin, license, lastServiceDate, previousRecords, lastMileage, currentMileage, knownIssues, serviceType, serviceDate, serviceTime, serviceLocation, specificRequests, paymentMethod, billingAddress, insuranceInfo, warrantyInfo) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

        // Set parameters and execute
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $make = $_POST['make'];
        $model = $_POST['model'];
        $year = $_POST['year'];
        $vin = $_POST['vin'];
        $license = $_POST['license'];
        $lastServiceDate = $_POST['lastServiceDate'];
        $previousRecords = $_POST['previousRecords'];
        $lastMileage = $_POST['lastMileage'];
        $currentMileage = $_POST['currentMileage'];
        $knownIssues = $_POST['knownIssues'];
        $serviceType = $_POST['serviceType'];
        $serviceDate = $_POST['serviceDate'];
        $serviceTime = $_POST['serviceTime'];
        $serviceLocation = $_POST['serviceLocation'];
        $specificRequests = $_POST['specificRequests'];
        $paymentMethod = $_POST['paymentMethod'];
        $billingAddress = $_POST['billingAddress'];
        $insuranceInfo = $_POST['insuranceInfo'];
        $warrantyInfo = $_POST['warrantyInfo'];

        $stmt->bind_param("ssssssisississsssssssss", 
                  $name, $phone, $email, $address, $make, $model, $year, $vin, $license, 
                  $lastServiceDate, $previousRecords, $lastMileage, $currentMileage, $knownIssues, 
                  $serviceType, $serviceDate, $serviceTime, $serviceLocation, $specificRequests, 
                  $paymentMethod, $billingAddress, $insuranceInfo, $warrantyInfo);

        // Execute the prepared statement
        if ($stmt->execute()) {
            echo "<script>alert('Form has been successfully submitted');</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }

        // Close statement
        $stmt->close();
    } else {
        $error_message = "Error: The following fields are required: " . implode(', ', $errors);
        echo "<script>alert('$error_message');</script>";
    }

    // Close connection
    $conn->close();
}
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
                    <img src="assets\Images\maintenance-page-carousel1.jpg" class="d-block w-100" alt="Slide 1">
                    <div class="carousel-caption kb-caption kb-caption-center">
                      <h1 data-animation="animated">Extend Your Car's Lifespan</h1>
                      <h3 data-animation="animated">Regular Maintenance for a Long-Lasting Vehicle.</h3>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img src="assets\Images\maintenance-page-carousel2.jpg" class="d-block w-100" alt="Slide 2">
                    <div class="carousel-caption kb-caption kb-caption-center">
                      <h1 data-animation="animated">Improve Fuel Efficiency</h1>
                      <h3 data-animation="animated">Save Money at the Pump with Proper Car Care.</h3>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img src="assets\Images\maintenance-page-carousel3.jpg" class="d-block w-100" alt="Slide 3">
                    <div class="carousel-caption kb-caption kb-caption-center">
                      <h1 data-animation="animated">Enhance Safety on the Road</h1>
                      <h3 data-animation="animated">Preventive Maintenance for Peace of Mind.</h3>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img src="assets\Images\maintenance-page-carousel4.jpg" class="d-block w-100" alt="Slide 3">
                    <div class="carousel-caption kb-caption kb-caption-center">
                      <h1 data-animation="animated">Boost Performance</h1>
                      <h3 data-animation="animated">Keeping Your Car Running Smoothly and Powerfully.</h3>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img src="assets\Images\maintenance-page-carousel5.jpg" class="d-block w-100" alt="Slide 3">
                    <div class="carousel-caption kb-caption kb-caption-center">
                      <h1 data-animation="animated">Retain Resale Value</h1>
                      <h3 data-animation="animated">Keep Your Car's Value High with Regular Upkeep.</h3>
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
    <!-- Car Maintenance Service Form -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
         <!-- Personal Information -->
        <fieldset>
            <legend>Personal Information</legend>
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" required><br><br>
            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" required><br><br>
            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" required><br><br>
            <label for="address">Address:</label>
            <textarea id="address" name="address" rows="3" required></textarea><br><br>
        </fieldset>

        <!-- Vehicle Information -->
        <fieldset>
            <legend>Vehicle Information</legend>
            <label for="make">Make:</label>
            <input type="text" id="make" name="make" required><br><br>
            <label for="model">Model:</label>
            <input type="text" id="model" name="model" required><br><br>
            <label for="year">Year of Manufacture:</label>
            <input type="year" id="year" name="year" required><br><br>
            <label for="vin">Vehicle Identification Number (VIN):</label>
            <input type="text" id="vin" name="vin" required><br><br>
            <label for="license">License Plate Number:</label>
            <input type="text" id="license" name="license" required><br><br>
        </fieldset>

        <!-- Service History -->
        <fieldset>
            <legend>Service History</legend>
            <label for="lastServiceDate">Date of Last Service:</label>
            <input type="date" id="lastServiceDate" name="lastServiceDate" required><br><br>
            <label for="previousRecords">Previous Maintenance Records:</label>
            <textarea id="previousRecords" name="previousRecords" rows="5" required></textarea><br><br>
            <label for="lastMileage">Mileage at Last Service:</label>
            <input type="number" id="lastMileage" name="lastMileage" required><br><br>
        </fieldset>

        <!-- Current Vehicle Status -->
        <fieldset>
            <legend>Current Vehicle Status</legend>
            <label for="currentMileage">Current Mileage:</label>
            <input type="number" id="currentMileage" name="currentMileage" required><br><br>
            <label for="knownIssues">Any Known Issues or Symptoms:</label>
            <textarea id="knownIssues" name="knownIssues" rows="3"></textarea><br><br>
            <label for="serviceType">Preferred Service Type:</label>
            <select id="serviceType" name="serviceType" required>
                <option value="oilChange">Oil Change</option>
                <option value="tireRotation">Tire Rotation</option>
                <option value="fullInspection">Full Inspection</option>
                <option value="other">Other</option>
            </select><br><br>
        </fieldset>

        <!-- Preferred Service Details -->
        <fieldset>
            <legend>Preferred Service Details</legend>
            <label for="serviceDate">Desired Date for Service:</label>
            <input type="date" id="serviceDate" name="serviceDate" required><br><br>
            <label for="serviceTime">Desired Time for Service:</label>
            <input type="time" id="serviceTime" name="serviceTime" required><br><br>
            <label for="serviceLocation">Preferred Service Location:</label>
            <input type="text" id="serviceLocation" name="serviceLocation" required><br><br>
            <label for="specificRequests">Any Specific Requests or Concerns:</label>
            <textarea id="specificRequests" name="specificRequests" rows="3"></textarea><br><br>
        </fieldset>

        <!-- Payment Information -->
        <fieldset>
            <legend>Payment Information</legend>
            <label for="paymentMethod">Payment Method:</label>
            <select id="paymentMethod" name="paymentMethod" required>
                <option value="creditCard">Credit Card</option>
                <option value="paypal">PayPal</option>
                <option value="other">Other</option>
            </select><br><br>
            <label for="billingAddress">Billing Address (if different):</label>
            <textarea id="billingAddress" name="billingAddress" rows="3"></textarea><br><br>
        </fieldset>

        <!-- Additional Documentation -->
        <fieldset>
            <legend>Additional Documentation</legend>
            <label for="insuranceInfo">Insurance Information (if relevant):</label>
            <textarea id="insuranceInfo" name="insuranceInfo" rows="3"></textarea><br><br>
            <label for="warrantyInfo">Warranty Information (if applicable):</label>
            <textarea id="warrantyInfo" name="warrantyInfo" rows="3"></textarea><br><br>
        </fieldset>
        <!-- Submit Button -->
        <input type="submit" name="submit" value="Submit">
    </form>
    </div>
</main>
<?php
include 'footer.php';?>