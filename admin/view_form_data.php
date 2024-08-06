<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Details</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400;700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets\css\styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM form_part1 WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $id       = $row['id'];
        $full_name     = $row['full_name'];
        $email    = $row['email'];
        $phone = $row['phone'];
        $message  = $row['message'];
        $ip_address = $row['ip_address']; // assuming 'ip_address' is the column name
    } else {
        echo "No data found for this ID.";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}
?>
<div class="container">
<h1>Query Details</h1>
<table>
    <tr>
        <th>Full Name:</th>
        <td><?= $full_name;?></td>
    </tr>
    <tr>
        <th>Email:</th>
        <td><?= $email;?></td>
    </tr>
    <tr>
        <th>Phone:</th>
        <td><?= $phone;?></td>
    </tr>
    <tr>
        <th>Message:</th>
        <td><?= $message;?></td>
    </tr>
    <tr>
        <th>IP Address:</th>
        <td><?= $ip_address;?></td>
    </tr>
</table>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <form action="<?php echo $_SERVER['HTTP_REFERER']; ?>" method="post">
                <input type="submit" value="Back" name="submit" class="btn btn-lg custom-btn">
            </form>
        </div>
        <div class="col-md-6">
            <form action="delete_form_data.php" method="post" onsubmit="return confirm('Are you sure you want to delete this query?')">
                <input type="hidden" name="query_id" value="<?= $id?>">
                <button type="submit" class="btn btn-lg custom-btn">Delete</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>