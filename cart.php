<?php
   session_start();
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
       // Collect the form data
       $email = $_POST['email'];
       $password = $_POST['password'];
   
       // Connect to the database
       $host = 'localhost'; 
       $user = 'root'; 
       $pwd = ''; 
       $dbname = 'bathik'; 
       $conn = new mysqli($host, $user, $pwd, $dbname);
       if ($conn->connect_error) {
           die('Connection failed: ' . $conn->connect_error);
       }
   
       // Check if the email exists in the database
       $sql = "SELECT * FROM users WHERE email = '$email'";
       $result = $conn->query($sql);
       if ($result->num_rows == 1) {
           // Verify the password
           $row = $result->fetch_assoc();
           if (password_verify($password, $row['password'])) {
               // Login successful
               $_SESSION['username'] = $row['username'];
               $_SESSION['email'] = $row['email'];
               $_SESSION['phone'] = $row['phone'];
               header('Location: dashboard');
               exit;
           } else {
               // Incorrect password
               $password_error = 'Incorrect password';
           }
       } else {
           // Email not found
           $email_error = 'Email not found';
       }
   
       $conn->close();
   
   
      
   }
   
   //  Connect to the database
   $dsn = 'mysql:host=localhost;dbname=bathik';
   $username = 'root';
   $password = '';
   $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
   $pdo = new PDO($dsn, $username, $password, $options);
   
    // Get product details
    if (isset($_GET['id'])) {
     $product_id = $_GET['id'];
     // $store_id = $_GET['id'];
   
     // Select product details
     $stmt = $pdo->query("SELECT * FROM products WHERE id='$product_id'");  
     $product_detials = $stmt->fetch();
   
     $stmt2 = $pdo->query("SELECT * FROM product_quantity WHERE product_id='$product_id'");  
     
    
   
     }
   
   
   
   ?>
<?php
   // Include the header file
   require_once  'header.php';
   
   ?>
<!-- Hero section start-->
<section class="hero" style="background-image: url('img/shopbanner.png');">
   <div class="container">
      <div class="row align-items-center">
         <div class="col-lg-6">
            <h1 class="hero-title"></h1>
         </div>
      </div>
   </div>
</section>
<!-- Hero section end -->
<!-- Single product  -->
<div class="container my-5">
   <div class="row">
      <div class="col-md-8">
         <div class="table-responsive">
            <table class="table">
               <thead>
                  <tr>
                     <th>PRODUCT</th>
                     <th>PRICE</th>
                     <th>QUANTITY</th>
                     <th>SUBTOTAL</th>
                     <th>REMOVE</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>Product A</td>
                     <td>$10.00</td>
                     <td>
                        <input type="number" class="form-control custom-input" value="1">
                     </td>
                     <td>$10.00</td>
                     <td>
                        <button class="btn btn-danger btn-remove" type="button">
                        <i class="fas fa-trash-alt"></i> 
                        </button>
                     </td>
                  </tr>
               </tbody>
               <tfoot>
                  <tr>
                     <td colspan="3" class="text-right"><strong>Total:</strong></td>
                     <td><strong>$80.00</strong></td>
                     <td></td>
                     <!-- empty cell for alignment -->
                  </tr>
               </tfoot>
            </table>
         </div>
      </div>
      <div class="col-md-4 border added-products">
         <!-- Product details section -->
         <h4>Product details</h4>
         <p>Description of the product goes here.</p>
         <div class="row">
            <div class="col-6">Price:</div>
            <div class="col-6 text-right">$10.00</div>
         </div>
         <hr class="border-bottom">
         <div class="row">
            <div class="col-6"><strong>Total amount</strong></div>
            <div class="col-6 text-right">$10.00</div>
         </div>
         <div class="text-center mt-4">
    <button class="btn btn-primary">PROCEED TO CHECKOUT</button>
  </div>
      </div>
   </div>
</div>
<!-- End Single product -->
<?php
   // Include the footer file
   require_once 'footer.php';
   
   ?>