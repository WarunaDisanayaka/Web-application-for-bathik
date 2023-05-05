<?php
error_reporting(E_ERROR | E_PARSE);

session_start();

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     // Collect the form data
//     $email = $_POST['email'];
//     $password = $_POST['password'];

//     // Connect to the database
//     $host = 'localhost'; 
//     $user = 'root'; 
//     $pwd = ''; 
//     $dbname = 'bathik'; 
//     $conn = new mysqli($host, $user, $pwd, $dbname);
//     if ($conn->connect_error) {
//         die('Connection failed: ' . $conn->connect_error);
//     }

//     // Check if the email exists in the database
//     $sql = "SELECT * FROM users WHERE email = '$email'";
//     $result = $conn->query($sql);
//     if ($result->num_rows == 1) {
//         // Verify the password
//         $row = $result->fetch_assoc();
//         if (password_verify($password, $row['password'])) {
//             // Login successful
//             $_SESSION['username'] = $row['username'];
//             $_SESSION['email'] = $row['email'];
//             $_SESSION['phone'] = $row['phone'];
//             header('Location: dashboard');
//             exit;
//         } else {
//             // Incorrect password
//             $password_error = 'Incorrect password';
//         }
//     } else {
//         // Email not found
//         $email_error = 'Email not found';
//     }

//     $conn->close();



// }

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
                  <?php
                  $total = 0;
                  while ($cart = $stmt->fetch()) {

                     ?>
                     <tr>
                        <td><?php echo $cart['product_name'] ?></td>
                        <td><?php echo $cart['product_price'] ?></td>
                        <td>
                           <input type="number" class="form-control custom-input" min="1" value="<?php echo $cart['qty'] ?>">
                        </td>
                        <td><?php echo number_format(($cart['product_price'] * $cart['qty']), 2) ?></td>
                        <td>
                           <a href="add_to_cart.php?remove=<?= $cart['id'] ?>" onclick="return confirm('Are you sure want to remove this item?')">
                           <button class="btn btn-danger btn-remove" type="button">
                           <i class="fas fa-trash-alt"></i> 
                           </button>
                           </a>
                        </td>
                     </tr>
                     <?php
                     $total = $total + ($cart['product_price'] * $cart['qty']);
                  }
                  ?>
               </tbody>
               <tfoot>
                  <tr>
                     <td colspan="3" class="text-right"><strong>Total:</strong></td>
                     <td><strong><?php echo number_format($total, 2) ?></strong></td>
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
         <?php
         $total = 0;
         while ($cart = $stmt2->fetch()) {
            $total = $total + ($cart['product_price'] * $cart['qty']);
            ?>
            <div class="row">
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
            <button class="btn btn-primary">PROCEED TO CHECKOUT</button>
            </a>
         </div>
      </div>
   </div>
</div>
<!-- End Single product -->
<?php
// Include the footer file
require_once 'footer.php';

?>