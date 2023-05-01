<?php
session_start();

//  Connect to the database
$dsn = 'mysql:host=localhost;dbname=bathik';
$username = 'root';
$password = '';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
$pdo = new PDO($dsn, $username, $password, $options);

// Select cart details
$stmt = $pdo->query("SELECT * FROM favourites");

// To product details
$stmt2 = $pdo->query("SELECT * FROM cart");

//   echo $_SESSION['shop'];
?>
<?php
// Include the header file
require_once 'header.php';

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
      <div class="col">
         <div class="table-responsive">
            <table class="table">
               <thead>
                  <tr>
                     <th>PRODUCT</th>
                     <th>PRICE</th>
                     <!-- <th>QUANTITY</th> -->
                     <!-- <th>SUBTOTAL</th> -->
                     <th>REMOVE</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                  $total = 0;
                  while ($cart = $stmt->fetch()) {

                      ?>
                              <tr>
                                 <td>
                                    <?php echo $cart['product_name'] ?>
                                    <img src="vendordashboard/<?php echo $cart['product_img']; ?>" width="70"> 
                                </td>
                                 <td><?php echo $cart['product_price'] ?></td>
                   
                             
                                 <td>
                                    <a href="add_to_favourites.php?remove=<?= $cart['id'] ?>" onclick="return confirm('Are you sure want to remove this item?')">
                                    <button class="btn btn-danger btn-remove" type="button">
                                    <i class="fas fa-trash-alt"></i> 
                                    </button>
                                    </a>
                                 </td>
                              </tr>
                              <?php
                      //   $total = $total + ($cart['product_price'] * $cart['qty']);
                  }
                  ?>
               </tbody>
               <!-- <tfoot>
                  <tr>
                     <td colspan="3" class="text-right"><strong>Total:</strong></td>
                     <td><strong><?php echo number_format($total, 2) ?></strong></td>
                     <td></td>
                    
                  </tr>
               </tfoot> -->
            </table>
         </div>
      </div>
      
   </div>
</div>
<!-- End Single product -->
<?php
// Include the footer file
require_once 'footer.php';

?>