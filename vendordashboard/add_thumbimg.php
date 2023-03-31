<?php
 if (isset($_POST['thumbnail'])) {
    // Collect the form data
    $banner_img = $_FILES['imagethumb'];
    $vendor_id = $_POST['vendor_id'];

// Validate image
$allowed_extensions = array('jpg', 'jpeg', 'png');
$file_extension = pathinfo($banner_img['name'], PATHINFO_EXTENSION);
if (empty($banner_img['name']) || !in_array($file_extension, $allowed_extensions)) {
    $errors[] = 'Invalid image. Please choose a valid image file (jpg, jpeg, or png) with a maximum size of 2MB.';
}   
    // If there are no errors, save the data to the database and upload the image
    if (empty($errors)) {
        // Connect to the database
        $host = 'localhost'; 
        $user = 'root'; 
        $pwd = ''; 
        $dbname = 'bathik'; 
        $conn = new mysqli($host, $user, $pwd, $dbname);
        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }

        // Move the uploaded document to the upload path
$uploadPath = 'uploads/'; // set your upload path here
$filename = uniqid() . '_' . $banner_img['name'];
$destination = $uploadPath . $filename;
if (!move_uploaded_file($banner_img['tmp_name'], $destination)) {
    $errors[] = 'Failed to upload the document. Please try again.';
}


       // Prepare the SQL statement
       
$stmt = $conn->prepare("UPDATE stores SET thumb_img = ? WHERE store_id = ?");
//    "UPDATE stores SET banner_img = ? WHERE store_id = ?";
// Bind the parameters
$stmt->bind_param("sd", $destination, $vendor_id);


       // Read the image data
$image_data = file_get_contents($banner_img['tmp_name']);


        // Execute the statement
        if ($stmt->execute() === TRUE) {
            header('Location: index.php');
            echo "<script>
            swal({
                title: 'Product added successfully',
                text: 'Your product has been added to the database!',
                icon: 'success',
                button: 'OK'
            });
            </script>";
        } else {
            // Form submission failed, show SweetAlert message
            echo 'Error: ' . $conn->error;
            echo "<script>
            swal({
                title: 'Warning!',
                text: 'Something went wrong!',
                icon: 'warning',
                button: 'OK'
            });
            </script>";
        }

        // Close the statement and the database connection
        $stmt->close();
        $conn->close();
    } else {
        // // Display the errors
        // foreach ($errors as $error) {
        //     echo $error . '<br>';
        // }
    }
}

?>