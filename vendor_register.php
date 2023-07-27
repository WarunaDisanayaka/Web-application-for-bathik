<?php
// Include the header file
require_once 'header.php';
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   // Collect the form data
   $store_name = $_POST['store_name'];
   $phone_number = $_POST['phone_number'];
   $full_name = $_POST['full_name'];
   $customization = $_POST['design'];
   $location = $_POST['location'];
   $address = $_POST['address'];
   $document = $_FILES['document'];
   $email = $_POST['email'];
   $password = $_POST['password'];
   $confirmPassword = $_POST['confirm_password'];

   // Validate store name
   if (empty($store_name) || !preg_match('/^[a-zA-Z0-9_ ]{4,}$/', $store_name)) {
      $errors[] = 'Invalid store name. Please enter a valid store name with at least 4 characters.';
   }

   // Validate phone number
   if (empty($phone_number) || !preg_match('/^\d{10}$/', $phone_number)) {
      $errors[] = 'Invalid phone number. Please enter a 10-digit phone number.';
   }

   // Validate full name
   if (empty($full_name) || !preg_match('/^[a-zA-Z ]{4,}$/', $full_name)) {
      $errors[] = 'Invalid full name. Please enter a valid full name with at least 4 characters.';
   }

   // Validate customization
   if (empty($customization)) {
      $errors[] = 'Please select design customization .';
   }

   // Validate location
   if (empty($location)) {
      $errors[] = 'Please select a location.';
   }

   // Validate address
   if (empty($address)) {
      $errors[] = 'Please enter an address.';
   }

   // Validate document upload
   $allowedExtensions = array('pdf', 'doc', 'docx');
   $extension = pathinfo($document['name'], PATHINFO_EXTENSION);
   if (empty($document) || !in_array($extension, $allowedExtensions)) {
      $errors[] = 'Invalid document upload. Please upload a PDF, DOC, or DOCX file.';
   }

   // Validate email
   if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors[] = 'Invalid email. Please enter a valid email address.';
   }

   // Validate password
   if (empty($password) || !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password)) {
      $errors[] = 'Invalid password. Please enter a password with at least 8 characters, including at least one uppercase letter, one lowercase letter, one number, and one special character.';
   }

   // Validate confirm password
   if ($password !== $confirmPassword) {
      $errors[] = 'Passwords do not match. Please try again.';
   }

   // Generate a secure hash of the password
   $hashed_password = password_hash($password, PASSWORD_DEFAULT);

   // If there are no errors, save the data to the database
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
      $filename = uniqid() . '_' . $document['name'];
      $destination = $uploadPath . $filename;
      if (!move_uploaded_file($document['tmp_name'], $destination)) {
         $errors[] = 'Failed to upload the document. Please try again.';
      }


      // Save the data to the database
      $sql = "INSERT INTO stores (storename, phonenumber, ownername,customization, location, address, email, password, document,active) 
              VALUES ('$store_name', '$phone_number', '$full_name','$customization' ,'$location', '$address', '$email', '$hashed_password', '$filename',0)";
      if ($conn->query($sql) === TRUE) {
         // Form submitted successfully, show SweetAlert message
         echo "<script>
         swal({
             title: 'Registration successful',
             text: 'Thank you for registering!',
             icon: 'success',
             button: 'OK'
         }).then(function() {
             window.location.href = 'vendor_login.php';
         });
     </script>";

      } else {
         //echo 'Error: ' . $sql . '<br>' . $conn->error;
         // Form submitted successfully, show SweetAlert message
         echo "<script>
          swal({
              title: 'Warning!',
              text: 'Something went wrong!',
              icon: 'warning',
              button: 'OK'
          });
      </script>";
      }

      $conn->close();
   } else {
      // // Display the errors
      // foreach ($errors as $error) {
      //     echo $error . '<br>';
      // }
   }
}
?>
<!-- Hero section start-->
<section class="hero" style="background-image: url('img/hero.png');">
   <div class="container">
      <div class="row align-items-center">
         <div class="col-lg-6">
            <h1 class="hero-title">Becom a vendor</h1>
         </div>
      </div>
   </div>
</section>
<!-- Hero section end -->
<!-- Register start -->
<div class="container mt-5">
   <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
         <div class="card border-0">
            <div class="card-body">
               <h5 class="card-title text-center">Create your Vendor Account Here</h5>
               <?php
               // Form is invalid. Show the errors to the user.
               if (!empty($errors)) {
                  echo '<div class="alert alert-danger" role="alert">';
                  foreach ($errors as $error) {
                     echo '<p>' . $error . '</p>';
                  }
                  echo '</div>';
               }
               ?>
               <form method="POST" action="vendor_register.php" enctype="multipart/form-data">
                  <div class="mb-3">
                     <label for="storename" class="form-label">Store Name</label>
                     <input type="text" class="form-control" id="storename" name="store_name" value="<?php echo isset($store_name) ? $store_name : ''; ?>">
                  </div>
                  <div class="mb-3">
                     <label for="phonenumber" class="form-label">Phone Number</label>
                     <input type="tel" class="form-control" id="phonenumber" name="phone_number" value="<?php echo isset($phone_number) ? $phone_number : ''; ?>">
                  </div>
                  <div class="mb-3">
                     <label for="ownername" class="form-label">Owner's Full Name</label>
                     <input type="text" class="form-control" id="ownername" name="full_name" value="<?php echo isset($full_name) ? $full_name : ''; ?>">
                  </div>
                  <div class="mb-3">
                     <label>Design Customization:</label><br>
                     <input type="radio" id="basic" name="design" value="yes">
                     <label for="basic">Yes</label><br>
                     <input type="radio" id="premium" name="design" value="no">
                     <label for="premium">No</label><br>
                  </div>
                  <div class="mb-3">
                     <label for="location" class="form-label">Select Location</label>
                     <select class="form-select" id="location" name="location">
                        <option value="">Select Location</option>
                        <option value="Colombo" <?php echo isset($location) && $location == 'Colombo' ? 'selected' : ''; ?>>Colombo</option>
                        <option value="Kandy" <?php echo isset($location) && $location == 'Kandy' ? 'selected' : ''; ?>>Kandy</option>
                        <option value="Galle" <?php echo isset($location) && $location == 'Galle' ? 'selected' : ''; ?>>Galle</option>
                        <option value="Ampara" <?php echo isset($location) && $location == 'Ampara' ? 'selected' : ''; ?>>Ampara</option>
                        <option value="Anuradhapura" <?php echo isset($location) && $location == 'Anuradhapura' ? 'selected' : ''; ?>>Anuradhapura</option>
                        <option value="Badulla" <?php echo isset($location) && $location == 'Badulla' ? 'selected' : ''; ?>>Badulla</option>
                        <option value="Batticaloa" <?php echo isset($location) && $location == 'Batticaloa' ? 'selected' : ''; ?>>Batticaloa</option>
                        <option value="Gampaha" <?php echo isset($location) && $location == 'Gampaha' ? 'selected' : ''; ?>>Gampaha</option>
                        <option value="Hambantota" <?php echo isset($location) && $location == 'Hambantota' ? 'selected' : ''; ?>>Hambantota</option>
                        <option value="Jaffna" <?php echo isset($location) && $location == 'Jaffna' ? 'selected' : ''; ?>>Jaffna</option>
                        <option value="Kalutara" <?php echo isset($location) && $location == 'Kalutara' ? 'selected' : ''; ?>>Kalutara</option>
                        <option value="Kegalle" <?php echo isset($location) && $location == 'Kegalle' ? 'selected' : ''; ?>>Kegalle</option>
                        <option value="Kilinochchi" <?php echo isset($location) && $location == 'Kilinochchi' ? 'selected' : ''; ?>>Kilinochchi</option>
                        <option value="Kurunegala" <?php echo isset($location) && $location == 'Kurunegala' ? 'selected' : ''; ?>>Kurunegala</option>
                        <option value="Mannar" <?php echo isset($location) && $location == 'Mannar' ? 'selected' : ''; ?>>Mannar</option>
                        <option value="Matale" <?php echo isset($location) && $location == 'Matale' ? 'selected' : ''; ?>>Matale</option>
                        <option value="Matara" <?php echo isset($location) && $location == 'Matara' ? 'selected' : ''; ?>>Matara</option>
                        <option value="Monaragala" <?php echo isset($location) && $location == 'Monaragala' ? 'selected' : ''; ?>>Monaragala</option>
                        <option value="Mullativu" <?php echo isset($location) && $location == 'Mullativu' ? 'selected' : ''; ?>>Mullativu</option>
                        <option value="Nuwara Eliya" <?php echo isset($location) && $location == 'Nuwara Eliya' ? 'selected' : ''; ?>>Nuwara Eliya</option>
                        <option value="Polonnaruwa" <?php echo isset($location) && $location == 'Polonnaruwa' ? 'selected' : ''; ?>>Polonnaruwa</option>
                        <option value="Puttalam" <?php echo isset($location) && $location == 'Puttalam' ? 'selected' : ''; ?>>Puttalam</option>
                        <option value="Ratnapura" <?php echo isset($location) && $location == 'Ratnapura' ? 'selected' : ''; ?>>Ratnapura</option>
                        <option value="Trincomalee" <?php echo isset($location) && $location == 'Trincomalee' ? 'selected' : ''; ?>>Trincomalee</option>
                        <option value="Vavuniya" <?php echo isset($location) && $location == 'Vavuniya' ? 'selected' : ''; ?>>Vavuniya</option>
                     </select>
                  </div>
                  <div class="mb-3">
                     <label for="address" class="form-label">Address</label>
                     <textarea class="form-control" id="address" name="address" rows="3"><?php echo isset($address) ? $address : ''; ?></textarea>
                  </div>
                  <div class="mb-3">
                     <label for="document" class="form-label">Upload PDF Document</label>
                     <input type="file" class="form-control" id="document" name="document">
                  </div>
                  <div class="mb-3">
                     <label for="email" class="form-label">Email</label>
                     <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
                  </div>
                  <div class="mb-3">
                     <label for="password" class="form-label">Password</label>
                     <input type="password" class="form-control" id="password" name="password" value="<?php echo isset($password) ? $password : ''; ?>">
                  </div>
                  <div class="mb-3">
                     <label for="confirm-password" class="form-label">Confirm Password</label>
                     <input type="password" class="form-control" id="confirm-password" name="confirm_password" value="<?php echo isset($confirm_password) ? $confirm_password : ''; ?>">
                  </div>
                  <div class="d-grid gap-2">
                     <button type="submit" class="btn btn-lg btn-dark">Register</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Register end -->
<?php
// Include the footer file
require_once 'footer.php';

?>