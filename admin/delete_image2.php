<?php

    $imageName = $_POST['image'];
    $imageType = $_POST['type'];

// Define the path to the image file
    $imagePath = "Add news/" . $imageName;

    include 'db.php';

    // Delete the image from the database
    if ($imageType === 'single') {
        // Update the database to set the image field to an empty string
        $sql = "UPDATE news SET image = '' WHERE image = '$imageName'";
        if (mysqli_query($conn, $sql)) {
            echo "Single image deleted from database successfully.";
        } else {
            echo "Error deleting single image from database: " . mysqli_error($conn);
        }
    } else if ($imageType === 'multiple') {
        $sql = "SELECT image FROM news";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $existing_images = explode(',', $row['image']);
            $key = array_search($imageName, $existing_images);
            if ($key !== false) {
                unset($existing_images[$key]);
                $new_images = implode(',', $existing_images);
                $sql_update = "UPDATE news SET image = '$new_images' WHERE image LIKE '%$imageName%'";
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