<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AJ's FastLane</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400;700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../assets/css/styles.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <title>Form</title>
</head>
<body>
  <?php
  // Initialize variables
  $full_name = $email = $phone = $message = '';

  // Check if form is submitted
  if (isset($_POST['submit'])) {
    // Get the form values
    $full_name = $_POST['full_name'];
    $email    = $_POST['email'];
    $phone = $_POST['phone'];
    $message  = $_POST['message'];

    // Validate form fields
    if (empty($full_name) || empty($phone) || empty($email) || empty($message)) {
      $error = 'Please fill in all fields';
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $full_name)) {
      $error = 'Name can only contain letters and spaces';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error = 'Invalid email address';
    } else {
      // Establish connection to database
      $conn = mysqli_connect("localhost", "root", "", "cars_webpage");

      // Check connection
      if (!$conn) {
        die("Connection failed: ". mysqli_connect_error());
      }

      // Insert data into the database
      $stmt = mysqli_prepare($conn, "INSERT INTO form_part1 (full_name, phone, email, message, ip_address) VALUES (?,?,?,?,?)");
      mysqli_stmt_bind_param($stmt, 'sssss', $full_name, $phone, $email, $message, $_SERVER['REMOTE_ADDR']);
      mysqli_stmt_execute($stmt);

      if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "<script>alert('Data is successfully inserted'); window.location.href='task1(form).php';</script>";
      } else {
        echo "<script>alert('Error inserting data'); window.location.href='task1(form).php';</script>";
      }
      mysqli_stmt_close($stmt);
      mysqli_close($conn);
    }
  }
 ?>
  <div class="container">
    <h1>Form</h1>
    <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; }?>
    <div class="grid-8 form">
      <form action="" method="post" id="contact_form">
        <div class="form-inline clearfix">
          <div class="form-group grid-6 ">
            <input type="text" pattern="[a-zA-Z ]*" placeholder="full_name" id="exampleInputfull_name" name="full_name" class="form-control" value="<?php echo $full_name;?>">
          </div>
          <div class="form-group grid-6">
            <input type="email" placeholder="email address" id="exampleInputEmail" name="email" class="form-control" value="<?php echo $email;?>">
          </div>
          <div class="form-group grid-6">
            <input type="number" placeholder="Phone Number" id="exampleInputPhone" name="phone" class="form-control" value="<?php echo $phone;?>">
          </div>
          <div class="form-group grid-12">
            <textarea placeholder="message" id="exampleInputMessage" rows="3" name="message" class="form-control"><?php echo $message;?></textarea>
          </div>
        </div>
        <div class="form-group">
          <div style="display:none;" class="success" id="mail_success">Your message has been sent successfully.
          </div><!-- success message -->
          <div style="display:none;" class="error" id="mail_fail"> Sorry, error occured this time sending your message.
          </div><!-- error message -->
        </div>            
        <div id="submit" class="form-group grid-12">  
          <input type="submit" value="send" name="submit" class="btn  btn-lg costom-btn" id="send_message">
        </div>            
      </form>
    </div>    
  </div>  
</body>
</html>