<?php
include ('header.php'); 

if (isset($_POST['submit'])) {
    // Get the form values
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $subject  = $_POST['subject'];
    $phone_no = $_POST['phone'];
    $message  = $_POST['message'];

    // Validate form fields
    if (empty($name) || empty($email) || empty($subject) || empty($phone_no) || empty($message)) {
        echo "<script>alert('Please fill in all fields'); window.location.href='contact.php';</script>";
        exit;
    }

    // Establish connection to database
    $conn = mysqli_connect("localhost", "root", "", "cars_webpage");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Insert data into the database
    $stmt = mysqli_prepare($conn, "INSERT INTO query (name, email, subject, phone_no, message) VALUES (?,?,?,?,?)");
    mysqli_stmt_bind_param($stmt, 'sssss', $name, $email, $subject, $phone_no, $message);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "<script>alert('Data is successfully inserted'); window.location.href='contact.php';</script>";
    } else {
        echo "<script>alert('Error inserting data'); window.location.href='contact.php';</script>";
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>

<main>
  <section class="contact">
    <div class="banner" style="padding: 40px;
    background: url('./assets/Images/banner.png');">
      <h1 >Contact Us</h1>
    </div>
  <div class="layout">   
        <div class="text-center">          
          <p>Get in touch with AJ's FastLane to explore our extensive inventory of new and used cars.</p>
          <p id="contact-intro"> Our dedicated team is here to help you find the perfect vehicle for your needs.</p>
          <p id="contact-intro"> Contact us today to schedule a test drive or ask any questions!</p>
        </div>
        <div class="grid-8 form">
          <form action="" method="post" id="contact_form" name="contactForm">
            <div class="form-inline clearfix">
              <div class="form-group grid-6 ">
                <input type="text" placeholder="name" id="exampleInputName" name="name" class="form-control">
              </div>
              <div class="form-group grid-6">
                <input type="email" placeholder="email address" id="exampleInputEmail" name="email" class="form-control">
              </div>
              <div class="form-group grid-6">
                <input type="text" placeholder="subject" id="exampleInputSubject" name="subject" class="form-control">
              </div>
              <div class="form-group grid-6">
                <input type="number" placeholder="Phone Number" id="exampleInputPhone" name="phone" class="form-control">
              </div>
              <div class="form-group grid-12">
                <textarea placeholder="message" id="exampleInputMessage" rows="3" name="message" class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group">
              <div style="display:none;" class="success" id="mail_success">Your message has been sent successfully.
              </div><!-- success message -->
              <div style="display:none;" class="error" id="mail_fail"> Sorry, error occured this time sending your message.
              </div><!-- error message -->
              </div>            
            <div id="submit" class="form-group grid-12">  
              <input type="submit" value="send" name="submit"class="btn  btn-lg costom-btn" id="send_message">
            </div>
            
          </form>
        </div> <!-- /.col-xs-12 .col-sm-offset-2 .col-sm-8 -->
        <div class="grid-12">       
          <div class="icon-text">
            <span>find us on</span>
          </div><!-- /.icon-text -->
          <div class="icon-holder">
            <ul>
              <li><a target="_blank" href="#"><img src="assets\Images\facebook-icon.png"><i class="fa fa-facebook"></i></a></li>
              <li><a target="_blank" href="#"><img src="assets\Images\google-plus-icon.png"><i class="fa fa-google-plus"></i></a></li>
              <li><a target="_blank" href="#"><img src="assets\Images\twitter-icon.png"><i class="fa fa-twitter"></i></a></li>
              <li><a target="_blank" href="#"><img src="assets\Images\instagram-icon.png"><i class="fa fa-instagram"></i></a></li>
              <li><a target="_blank" href="#"><img src="assets\Images\linkdeln-icon.png"><i class="fa fa-linkedin"></i></a></li>
            </ul>
          </div><!-- /.icon-holder -->
        </div><!-- /.col-xs-12 -->     
  </div>  
</section>
</main>
<?php include ('footer.php'); ?>