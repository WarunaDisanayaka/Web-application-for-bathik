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
                  <input class="form-check-input" type="radio" name="payment_method" id="credit_card" value="Cash on Delivery" checked>
                  <label class="form-check-label" for="credit_card">
                  Cash on Delivery
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
      $total = 0;
      while ($cart = $stmt2->fetch()) {
         $total = $total + ($cart['product_price'] * $cart['qty']);
         ?>
                                       <div class="row">
                                       <input type="hidden" name="shop" value="<?php echo $cart['shop'] ?>">
                                       <p class="col-6"><?php echo $cart['product_name'] ?>-<?php echo $cart['qty'] ?></p>
                                       <div class="col-6 text-right"><?php echo number_format(($cart['product_price'] * $cart['qty']), 2) ?></div>
                                       </div>
                                       <?php
      }
      ?>
      <hr class="border-bottom">
      <div class="row">
      <div class="col-6"><strong>Total amount</strong></div>
      <div class="col-6 text-right"><?php echo number_format($total, 2) ?></div>
      </div>
      <div class="text-center mt-4">
      <a href="checkout.php">
      <button class="btn btn-primary">PLACE ORDER</button>
      </a>
      <div id="paypal-payment-button">

                        </div>

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