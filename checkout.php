<?php
   // Include the header file
   require_once  'header.php';
   
   ?>
<?php
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
   <div class="row">
      <div class="col-sm-8">
         <form class="row g-3">
            <div class="col-md-6">
               <label for="inputEmail4" class="form-label">First name</label>
               <input type="text" class="form-control" id="inputEmail4">
            </div>
            <div class="col-md-6">
               <label for="inputPassword4" class="form-label">Last name</label>
               <input type="text" class="form-control" id="inputPassword4">
            </div>
            <div class="col-12">
               <label for="inputAddress" class="form-label">Email</label>
               <input type="text" class="form-control" id="inputAddress" placeholder="">
            </div>
            <div class="col-12">
               <label for="inputAddress" class="form-label">Phone</label>
               <input type="text" class="form-control" id="inputAddress" placeholder="">
            </div>
            <div class="row g-3">
               <div class="col-sm-7">
                  <input type="text" class="form-control" placeholder="City" aria-label="City">
               </div>
               <div class="col-sm">
                  <input type="text" class="form-control" placeholder="State" aria-label="State">
               </div>
               <div class="col-sm">
                  <input type="text" class="form-control" placeholder="Zip" aria-label="Zip">
               </div>
            </div>
            <div class="form-group">
               <label for="exampleFormControlTextarea1">Address</label>
               <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
         </form>
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
      </div>
   </div>
</div>
<!-- Register end -->
<?php
   // Include the footer file
   require_once 'footer.php';
   
   ?>