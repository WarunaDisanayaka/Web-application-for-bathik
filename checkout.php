<?php
   // Include the header file
   require_once  'header.php';
   
   ?>
<?php
   session_start();

   //  Connect to the database
   $dsn = 'mysql:host=localhost;dbname=bathik';
   $username = 'root';
   $password = '';
   $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
   $pdo = new PDO($dsn, $username, $password, $options);
   
    // Select cart details
    $stmt = $pdo->query("SELECT * FROM cart");  
   
     // To product details
     $stmt2 = $pdo->query("SELECT * FROM cart");
     
     // Check if form was submitted
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
   // Connect to MySQL database
   $servername = 'localhost';
   $username = 'root';
   $password = '';
   $dbname = 'bathik';
   
   $conn = new mysqli($servername, $username, $password, $dbname);
   
   if ($conn->connect_error) {
       die('Connection failed: ' . $conn->connect_error);
   }
   
   // Validate form data
   $errors = array();
   
   if (empty($_POST['fname'])) {
       $errors[] = 'First name is required';
   }
   
   if (empty($_POST['lname'])) {
       $errors[] = 'Last name is required';
   }
   
   if (empty($_POST['email'])) {
       $errors[] = 'Email is required';
   } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
       $errors[] = 'Email is invalid';
   }
   
   if (empty($_POST['phone'])) {
       $errors[] = 'Phone is required';
   }
   
   if (empty($_POST['address'])) {
       $errors[] = 'Address is required';
   }
   
   if (empty($_POST['city'])) {
       $errors[] = 'City is required';
   }
   
   if (empty($_POST['state'])) {
       $errors[] = 'State is required';
   }
   
   if (empty($_POST['payment_method'])) {
      $errors[] = 'Payment method is required';
   }
      
   if (empty($_POST['zip'])) {
       $errors[] = 'Zip is required';
   } else if (!is_numeric($_POST['zip'])) {
       $errors[] = 'Zip is invalid';
   }
   
   if (count($errors) == 0) {
       
       // Insert data into database
       $fname = $_POST['fname'];
       $lname = $_POST['lname'];
       $email = $_POST['email'];
       $phone = $_POST['phone'];
       $address = $_POST['address'];
       $city = $_POST['city'];
       $state = $_POST['state'];
       $zip = $_POST['zip'];
       $payment = $_POST['payment_method'];
       $shop = $_POST['shop'];
       
       $sql = "INSERT INTO orders (first_name, last_name, email, phone, city, state, zip, address,payment_method,shop) VALUES ('$fname', '$lname', '$email', '$phone', '$city', '$state', '$zip','$address','$payment','$shop')";
       
       
       if ($conn->query($sql) === TRUE) {
           echo 'Data inserted successfully';
       } else {
           echo 'Error inserting data: ' . $conn->error;
       }
       
   } else {
       
   }
   
   $conn->close();
   
   }
   
   
   ?>
<!-- Hero section start-->
<section class="hero" style="background-image: url('img/hero.png');">
   <div class="container">
      <div class="row align-items-center">
         <div class="col-lg-6">
            <h1 class="hero-title">Checkout</h1>
         </div>
      </div>
   </div>
</section>
<!-- Hero section end -->
<!-- Register start -->
<div class="container mt-5 mb-5">
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
   <div class="row">
      <div class="col-sm-8">
         <form method="POST" action="checkout.php" class="row g-3">
            <div class="col-md-6">
               <label for="inputEmail4" class="form-label">First name</label>
               <input type="text" name="fname" class="form-control" id="inputEmail4">
            </div>
            <div class="col-md-6">
               <label for="inputPassword4" class="form-label">Last name</label>
               <input type="text" name="lname" class="form-control" id="inputPassword4">
            </div>
            <div class="col-12">
               <label for="inputAddress" class="form-label">Email</label>
               <input type="text" name="email" class="form-control" id="inputAddress" placeholder="">
            </div>
            <div class="col-12">
               <label for="inputAddress" class="form-label">Phone</label>
               <input type="text" name="phone" class="form-control" id="inputAddress" placeholder="">
            </div>
            <div class="row g-3">
               <div class="col-sm-7">
                  <input type="text" name="city" class="form-control" placeholder="City" aria-label="City">
               </div>
               <div class="col-sm">
                  <input type="text" name="state" class="form-control" placeholder="State" aria-label="State">
               </div>
               <div class="col-sm">
                  <input type="text" name="zip" class="form-control" placeholder="Zip" aria-label="Zip">
               </div>
            </div>
            <div class="form-group">
               <label for="exampleFormControlTextarea1">Address</label>
               <textarea class="form-control" name="address" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div class="col-md-4 payment-method">
               <label for="exampleFormControlTextarea1">Payment method</label>
               <div class="form-check">
                  <input class="form-check-input" type="radio" name="payment_method" id="credit_card" value="credit_card" checked>
                  <label class="form-check-label" for="credit_card">
                  Credit Card
                  </label>
               </div>
               <div class="form-check">
                  <input class="form-check-input" type="radio" name="payment_method" id="paypal" value="paypal">
                  <label class="form-check-label" for="paypal">
                  PayPal
                  </label>
               </div>
            </div>
      </div>
      <div class="col-md-4 border added-products">
      <!-- Product details section -->
      <h4>Product details</h4>
      <?php
         $total=0;
           while ($cart = $stmt2->fetch()) {
            $total=$total+($cart['product_price'] * $cart['qty']);
         ?>
      <div class="row">
      <input type="hidden" name="shop" value="<?php echo $cart['shop']?>">
      <p class="col-6"><?php echo $cart['product_name']?>-<?php echo $cart['qty']?></p>
      <div class="col-6 text-right"><?php echo number_format(($cart['product_price'] * $cart['qty']), 2)?></div>
      </div>
      <?php
         }
         ?>
      <hr class="border-bottom">
      <div class="row">
      <div class="col-6"><strong>Total amount</strong></div>
      <div class="col-6 text-right"><?php echo number_format($total,2) ?></div>
      </div>
      <div class="text-center mt-4">
      <a href="checkout.php">
      <button class="btn btn-primary">PLACE ORDER</button>
      </a>
      </div>
      </form>
      </div>
   </div>
</div>
<!-- Register end -->
<?php
   // Include the footer file
   require_once 'footer.php';
   
   ?>