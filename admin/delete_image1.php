<?php

    $imageName = $_POST['image'];
    $imageType = $_POST['type'];

// Define the path to the image file
    $imagePath = "Sell Car/" . $imageName;

    include 'db.php';

    // Delete the image from the database
    if ($imageType === 'single') {
        // Update the database to set the car_image field to an empty string
        $sql = "UPDATE buying SET car_image = '' WHERE car_image = '$imageName'";
        if (mysqli_query($conn, $sql)) {
            echo "Single image deleted from database successfully.";
        } else {
            echo "Error deleting single image from database: " . mysqli_error($conn);
        }
    } else if ($imageType === 'multiple') {
        $sql = "SELECT car_detail_img FROM buying";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $existing_images = explode(',', $row['car_detail_img']);
            $key = array_search($imageName, $existing_images);
            if ($key !== false) {
                unset($existing_images[$key]);
                $new_images = implode(',', $existing_images);
                $sql_update = "UPDATE buying SET car_detail_img = '$new_images' WHERE car_detail_img LIKE '%$imageName%'";
                if (mysqli_query($conn, $sql_update)) {
                    echo "Multiple image deleted from database successfully.";
                } else {
                    echo "Error deleting multiple image from database: " . mysqli_error($conn);
                }
            }
        }
    }

    // Delete the image file
    try {
        if (file_exists($imagePath)) {
            unlink($imagePath);
            echo "Image file deleted successfully.";
        } else {
            echo "Image file not found.";
        }
    } catch (Exception $e) {
        echo "Error deleting image file: " . $e->getMessage();
    }

    // Close the database connection
    mysqli_close($conn);
?>