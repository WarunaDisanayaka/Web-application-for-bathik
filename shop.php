<?php
session_start();
// Include the header file
require_once 'header.php';
// Connect to the database
$dsn = 'mysql:host=localhost;dbname=bathik';
$username = 'root';
$password = '';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
$pdo = new PDO($dsn, $username, $password, $options);



if (isset($_GET['id'])) {
   $store_id = $_GET['id'];
   $_SESSION['shop'] = $_GET['id'];
   // Select all shops products
   $stmt = $pdo->query("SELECT * FROM `products` WHERE vendor_id='$store_id'");
   // Select store
   $store = $pdo->query("SELECT storename FROM stores WHERE store_id='$store_id'");
   $storeName = $store->fetch();
   // Ratings
   $ratings = $pdo->query("SELECT * FROM ratings WHERE shop='$store_id'");
   // $rate = $ratings->fetch();
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   // Get the form data
   $shop = $_POST['shop'];
   $review = $_POST['review'];
   $rating = $_POST['rating'];

   // Validate the form data
   // Validate review
   if (empty($review) || !preg_match('/^[a-zA-Z0-9_ ]{4,}$/', $review)) {
      echo '<script>
            alert("Enter your review")
            window.location.href = "shop.php?id=' . $_SESSION['shop'] . '";
         </script>';

   }

   // Validate star rating
   if (empty($rating) || !preg_match('/^\d{1}$/', $rating)) {
      echo '<script>
      alert("Please add your rating")
      window.location.href = "shop.php?id=' . $_SESSION['shop'] . '";
      </script>';
   }

   // Save the form data to the database
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

      // Save the data to the database
      $sql = "INSERT INTO ratings (shop, rating, review) VALUES ('$shop', '$rating', '$review')";
      if ($conn->query($sql) === TRUE) {
         // Form submitted successfully, show SweetAlert message
         echo "<script>
      swal({
         title: 'Review added successful',
         text: 'Thank you for your review!',
         icon: 'success',
         button: 'OK',
      }).then(function() {
         window.location.href = 'shop.php?id=" . $_SESSION["shop"] . "';
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
            <h1 class="hero-title"><?php echo $storeName['storename']; ?></h1>
         </div>
      </div>
   </div>
</section>
<!-- Hero section end -->
<!-- Product filter -->
<div class="container-fluid shop-content">
   <div class="row">
      <!-- Sidebar -->
      <div class="col-lg-3">
         <div class="card mb-3 border-0">
            <div class="card-body">
               <form>
                  <!-- <div class="mb-3">
                     <label for="color"><h4>Category</h4></label>
                     <div>
                        <input type="checkbox" id="red">
                        <label for="red" class="form-check-label">Sarees</label>
                     </div>
                     <div>
                        <input type="checkbox" id="blue">
                        <label for="blue" class="form-check-label">Shirts</label>
                     </div>
                     <div>
                        <input type="checkbox" id="green">
                        <label for="green" class="form-check-label">Dresses</label>
                     </div>
                     <div>
                        <input type="checkbox" id="black">
                        <label for="black" class="form-check-label">Black</label>
                     </div>
                     <div>
                        <input type="checkbox" id="white">
                        <label for="white" class="form-check-label">White</label>
                     </div>
                     </div> -->
                  <div class="mb-3">
                     <label for="color">
                        <h4>Materials</h4>
                     </label>
                     <div>
                        <input type="checkbox" id="red">
                        <label for="red" class="form-check-label">Linen</label>
                     </div>
                     <div>
                        <input type="checkbox" id="red">
                        <label for="red" class="form-check-label">Cotton</label>
                     </div>
                     <div>
                        <input type="checkbox" id="red">
                        <label for="red" class="form-check-label">Rayon</label>
                     </div>
                     <div>
                        <input type="checkbox" id="blue">
                        <label for="blue" class="form-check-label">Silk</label>
                     </div>
                  </div>
                  <div class="mb-3">
                     <label for="price">Price</label>
                     <input type="range" class="form-range" id="price" min="0" max="1000" step="50" value="500">
                     </div>
                  <button type="submit" class="btn btn-primary">Filter</button>
               </form>
               <div class="mb-3">
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
                  <form action="shop.php" method="POST">
                     <label for="textArea">
                        <h4>Your Comment</h4>
                     </label>
                     <textarea class="form-control" name="review" id="textArea" rows="3"></textarea>
               </div>
               <div class="mb-3">
               <label for="star-rating">
               <h4>Your Rating</h4>
               </label>
               <input type="hidden" name="shop" value="<?php echo $store_id; ?>">
               <input type="hidden" name="rating" id="rating-value">
               <div class="rating">
               <i class="fa fa-star fa-1x star-btn"  data-value="1"></i>
               <i class="fa fa-star fa-1x star-btn"  data-value="2"></i>
               <i class="fa fa-star fa-1x star-btn"  data-value="3"></i>
               <i class="fa fa-star fa-1x star-btn"  data-value="4"></i>
               <i class="fa fa-star fa-1x star-btn"  data-value="5"></i>
               </div>
               <button type="submit" class="btn btn-primary">Submit</button>
               </form>
               </div>
            </div>
         </div>
      </div>
      <!-- Product filter end -->
      <!-- Product List -->
      <div class="col-lg-9 products">
         <div class="row">
            <?php
            while ($row = $stmt->fetch()) {
               ?>
                                 <div class="col-lg-3 mb-4">
                                    <div class="card border-0">
                                       <img src="vendordashboard/<?php echo $row['image1'] ?>" alt="Product Image" class="card-img-top">
                                       <div class="card-body">
                                          <h6 class="card-title"><a href="single_product.php?id=<?php echo $row['id'] ?>"><?php echo $row['title'] ?></a></h6>
                                       </div>
                                    </div>
                                 </div>
                                 <?php
            }
            ?>
         </div>
      </div>
   </div>
</div>
</div>
<?php
while ($rate = $ratings->fetch()) {
   ?>
         <div class="container review-block">
            <p class="review-text"><?php echo substr($rate['review'], 0, 100) . '...' ?></p>
            <div class="review-rating">
               <span class="star-rating">
                  <?php
                  $rating = $rate['rating'];
                  for ($i = 1; $i <= 5; $i++) {
                     if ($i <= $rating) {
                        echo '<i class="fa fa-star checked"></i>';
                     } else {
                        // echo '<i class="fa fa-star"></i>';
                     }
                  }
                  ?>
               </span>
            </div>
         </div>
         <hr style="height: 2px;
      background-color: #ccc;
      width: 50%;
      margin: 20px auto;
      margin-left:6rem;"> <!-- add a horizontal rule divider after each review -->
      <?php
}
?>

<?php
// Include the footer file
require_once 'footer.php';

?>
<script>
   document.querySelectorAll('.star-btn').forEach(function(star) {
       star.addEventListener('click', function() {
           document.querySelectorAll('.star-btn').forEach(function(s) {
               if (s.getAttribute('data-value') <= star.getAttribute('data-value')) {
                   s.classList.remove('fa-star-o');
                   s.classList.add('fa-star');
               } else {
                   s.classList.remove('fa-star');
                   s.classList.add('fa-star-o');
               }
           });
           document.querySelector('#rating-value').value = star.getAttribute('data-value');
       });
   });
</script>