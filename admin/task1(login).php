<!DOCTYPE html style="height: 100% !important;">
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin's login page Page</title>
    <link rel="stylesheet" type="text/css" href="assets\css\styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
</head>
<?php
include 'db.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];

    // Query to retrieve user data
    $query = "SELECT * FROM form WHERE user_name =?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $user_name);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc();
        $hashed_password = $user_data['user_password'];

        // Verify password
        if (password_verify($user_password, $hashed_password)) {
            // Start a session
            session_start();
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $user_name;

            // Redirect to dashboard
            header('Location: task1(form_view).php');
            exit;
        } else {
            echo '<script>alert("Incorrect password!")</script>';
        }
    } else {
        echo '<script>alert("Username not found!")</script>';
    }
}

// Close connection
$conn->close();
?>
<body>
    <div id="gradient-bg">
        <div class="gradient-container">
            <div class="gradient1"></div>
            <div class="gradient2"></div>
            <div class="gradient3"></div>
            <div class="gradient4"></div>
            <div class="gradient5"></div>
        </div>
    </div>      
    <!-- Form -->
    <div id="form-container">
        <h1 class="title">Log in</h1>
        <form method="post">
            <div class="label">Username</div>
            <input type="text" name="user_name" />
            <div class="label">Password</div>
            <input type="password" name="user_password"/>
            <input type="submit" class="submit" name="log_in" value="Sign in"/>
        </form>
    </div>
    <script type="text/javascript" src="assets\JS\admin.js"></script>
</body>
</html>