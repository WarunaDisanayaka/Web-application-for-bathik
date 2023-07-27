<?php
error_reporting(E_ERROR | E_PARSE);

// Include the header file
require_once 'header.php';
?>
<?php
session_start();
setcookie('pred', $_GET['pred']);

$pred_value = $_GET['pred'];
setcookie('pred', $pred_value);
// echo "Predicted value: " . $pred_value;


$_SESSION['pred'] = $pred_value;

// echo $_SESSION['email'];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   // Collect the form data
   $shop = $_POST['shop'];
   $note = $_POST['note'];
   $document = $_FILES['document'];
   $email = $_POST['email'];
   $price = $_POST['price'];
   $user_id = $_SESSION['userid'];
   setcookie('pred', $_POST['price'], time() + 3600); // Set cookie for 1 hour



   // Validate shop
   if (empty($shop)) {
      $errors[] = 'Please select a shop.';
   }

   // Validate address
   if (empty($note)) {
      $errors[] = 'Please enter the note.';
   }

   // Validate document upload
   $allowedExtensions = array('jpg', 'jpeg', 'png');
   $extension = pathinfo($document['name'], PATHINFO_EXTENSION);
   if (empty($document) || !in_array($extension, $allowedExtensions)) {
      $errors[] = 'Invalid document upload. Please upload a PDF, DOC, or DOCX file.';
   }

   // Validate email
   if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors[] = 'Invalid email. Please enter a valid email address.';
   }

   // Validate price
   if (empty($price)) {
      $errors[] = 'Please enter a price.';
   }


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
      $uploadPath = 'vendordashboard/uploads/'; // set your upload path here
      $filename = uniqid() . '_' . $document['name'];
      $destination = $uploadPath . $filename;
      if (!move_uploaded_file($document['tmp_name'], $destination)) {
         $errors[] = 'Failed to upload the document. Please try again.';
      }


      // Save the data to the database
      $sql = "INSERT INTO design_orders (shop, note, design, email, price,user_id,status) 
              VALUES ('$shop', '$note', '$destination', '$email', '$price','$user_id','Proccessing')";
      if ($conn->query($sql) === TRUE) {
         // Form submitted successfully, show SweetAlert message
         echo "<script>
         Swal.fire({
           title: 'Order submit successful',
           text: 'Thank you for submitting your order!',
           icon: 'success',
           showConfirmButton: false,
           timer: 2000
         }).then(() => {
           window.location.href = 'my_account.php'; // Replace with your desired redirect URL
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

// Connect to the database
$dsn = 'mysql:host=localhost;dbname=bathik';
$username = 'root';
$password = '';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
$pdo = new PDO($dsn, $username, $password, $options);

// Select all shops
$stmt = $pdo->query('SELECT store_id,storename FROM stores WHERE customization="yes"');

?>
<!-- Hero section start-->
<section class="hero" style="background-image: url('img/hero.png');">
   <div class="container">
      <div class="row align-items-center">
         <div class="col-lg-6">
            <h1 class="hero-title">Submit your design</h1>
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
               <h5 class="card-title text-center">Submit your design</h5>
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
               <form method="POST" action="design_order.php" enctype="multipart/form-data">
                  <div class="mb-3">
                     <label for="location" class="form-label">Select Shop</label>
                     <select class="form-select" id="location" name="shop">
                       
                        <?php
                        $stmt = $pdo->query('SELECT store_id, storename FROM stores');
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                           $storeId = $row['store_id'];
                           $storename = $row['storename'];
                           echo '<option value="' . $storeId . '">' . $storename . '</option>';
                        }
                        ?>
                     </select>
                  </div>
                  <div class="mb-3">
                     <label for="address" class="form-label">Note</label>
                     <textarea class="form-control" id="note" name="note" rows="3"><?php echo isset($address) ? $address : ''; ?></textarea>
                  </div>
                  <div class="mb-3">
                     <label for="document" class="form-label">Upload Design Screen Shot</label>
                     <input type="file" class="form-control" id="document" name="document">
                  </div>
                  <div class="mb-3">
                     <label for="email" class="form-label">Email</label>
                     <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
                  </div>
                  <div class="mb-3">
                     <label for="email" class="form-label">Price</label>
                     <input type="text" class="form-control" id="email" name="price" value="<?php echo isset($_COOKIE['pred']) ? $_COOKIE['pred'] : $_SESSION['pred']; ?>" readonly>
                  </div>
                  <div class="mb-3">
  <label class="form-label">Card Type</label>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="cardType" id="visa" value="visa" checked>
    <label class="form-check-label" for="visa">Visa</label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="cardType" id="master" value="master">
    <label class="form-check-label" for="master">Master</label>
  </div>
</div>
                  <div class="mb-3">
                  <label class="form-label" for="typeText">Card Number</label>
                  <input type="text" id="typeText" class="form-control form-control-lg" siez="17"
                    placeholder="1234 5678 9012 3457" minlength="19" maxlength="19" />
                  </div>
                  <div class="mb-3">
                  <label class="form-label" for="typeName">Cardholder's Name</label>
                  <input type="text" id="typeName" class="form-control form-control-lg" siez="17"
                    placeholder="Cardholder's Name" />
                  </div>

                  <div class="input-group mb-3">
  <label class="input-group-text" for="expMMYYYY">Expire Date</label>
  <input type="text" id="expMM" class="form-control form-control-lg" placeholder="MM" pattern="(0[1-9]|1[0-2])" maxlength="2" required>
  <span class="input-group-text">/</span>
  <input type="text" id="expYYYY" class="form-control form-control-lg" placeholder="YYYY" pattern="\d{4}" maxlength="4" required>
</div>

                  <div class="mb-3">
                  <label class="form-label" for="typeText2">CVV</label>
                  <input type="password" id="typeText2" class="form-control form-control-lg"
                    placeholder="&#9679;&#9679;&#9679;" size="1" minlength="3" maxlength="3" />
                  

                  </div>
                  
                              
                  <div class="d-grid gap-2">
                     <button type="submit" class="btn btn-lg btn-dark">Submit</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
    function showPaymentConfirmation() {
     
    }
  </script>
<!-- Register end -->
<?php
// Include the footer file
require_once 'footer.php';

?>