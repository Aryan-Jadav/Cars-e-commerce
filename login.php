<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" >
  <title>Admin's login page Page</title>
  <link rel="stylesheet" type="text/css" href="assets\css\logincss.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?  family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
</head>
<?php
include 'admin/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sign Up form submission
    if (isset($_POST['sign_up'])) {
        $username = $_POST['user_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $ip_address= $_SERVER['REMOTE_ADDR'];

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare the SQL query
        $stmt = $conn->prepare("INSERT INTO user (user_name, email, password, ip_address) VALUES (?,?,?,?)");
        $stmt->bind_param("ssss", $username, $email, $hashed_password, $ip_address);
        $result = $stmt->execute();        
        if ($result) {
            echo "<script>alert('User created successfully!');</script>";
        } else {
            echo "<script>alert('Error creating user: " . $conn->error . "');</script>";
        }
      }

    // Log In form submission
    if (isset($_POST['log_in'])) {
        $username = $_POST['user_name'];
        $password = $_POST['password'];

        // Prepare the SQL query
        $stmt = $conn->prepare("SELECT * FROM user WHERE user_name =?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user_data = $result->fetch_assoc();
            $hashed_password = $user_data['password'];

            // Verify the password
            if (password_verify($password, $hashed_password)) {
                // Redirect to the site (e.g., dashboard.php)
                header('Location: index.php');
                exit;
            } else {
                echo "Invalid password";
            }
        } else {
            echo "User not found";
        }
    }
}
?>
<body>
  <div id="gradient-bg">
    <div calss="gradient-container">
      <div class="gradient1"></div>
      <div class="gradient2"></div>
      <div class="gradient3"></div>
      <div class="gradient4"></div>
      <div class="gradient5"></div>
    </div>
  </div> 
  <a href="<?php echo $_SERVER['HTTP_REFERER'];?>">
  <img src="admin\assets\Images\close-button.png" alt="Close Button" class="close-button"></a>
  <!-- Form -->
  <div id="form-container">
    <div class="form-wrapper sign-up">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <h1>Sign Up</h1>
                <div class="input-group">
                    <input type="text" required name="user_name">
                    <label for="">Username</label>
                </div>
                <div class="input-group">
                    <input type="email" required name="email">
                    <label for="">Email</label>
                </div>
                <div class="input-group">
                    <input type="password" required name="password">
                    <label for="">Password</label>
                </div>
                <button type="submit" class="btn" name="sign_up">Sign Up</button>
                <div class="sign-link">
                    <p>Already have an account? <a href="#" class="signIn-link">Sign In</a></p>
                </div>
            </form>
        </div>
        <div class="form-wrapper sign-in">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <h1>Log In</h1>
                    <div class="input-group">
                        <input type="text" required name="user_name">
                        <label for="">Username</label>
                    </div>
                    <div class="input-group">
                        <input type="password" required name="password">
                        <label for="">Password</label>
                    </div>
                    <button type="submit" class="btn" name="log_in">Login</button>
                <div class="sign-link">
                    <p>Don't have an account? <a href="#" class="signUp-link">Sign Up</a></p>
                </div>
            </form>
        </div>
  </div>
    <script type="text/javascript" src="assets\JS\loginJS.js"></script>
</body>
</html>