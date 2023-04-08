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
      <div class="col-md-6">
         <div class="carousel slide" data-bs-ride="carousel" id="productCarousel">
            <!-- <div class="carousel-inner">
               <div class="carousel-item active">
                  <img src="vendordashboard/<?php echo $product_detials['image1'];?>" class="product-img" alt="Product Image" class="d-block w-100">
               </div>
               <div class="carousel-item">
                  <img src="vendordashboard/<?php echo $product_detials['image2'];?>" class="product-img" alt="Product Image" class="d-block w-100">
               </div>
               <div class="carousel-item">
                  <img src="vendordashboard/<?php echo $product_detials['image3'];?>" class="product-img" alt="Product Image" class="d-block w-100">
               </div>
               </div> -->
            <div class="col">
               <div class="images p-3">
                  <div class="text-center p-4"> <img id="main-image" src="vendordashboard/<?php echo $product_detials['image1'];?>" class="product-img" alt="Product Image" class="d-block w-100" /> </div>
                  <div class="thumbnail text-center"> <img onclick="change_image(this)" src="vendordashboard/<?php echo $product_detials['image1'];?>" width="70"> <img onclick="change_image(this)" src="vendordashboard/<?php echo $product_detials['image2'];?>" width="70"> </div>
               </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
            </button>
         </div>
      </div>
      <div class="col-md-6">
         <h2 class="fw-bold"> <?php echo $product_detials['title'];?></h2>
         <p class="lead">Rs <?php echo $product_detials['price'];?></p>
         <p>Description of the product goes here.</p>
         <div class="mb-3">
            <label for="sizeSelect" class="form-label">Size</label>
            <select name="size" class="form-select" id="sizeSelect">
               <option selected>Select size</option>
               <?php
                  while ( $size = $stmt2->fetch()) {
                  ?>
               <option value="<?php echo $size['size'] ?>"><?php echo $size['size'] ?></option>
               <?php
                  }
                  ?>
            </select>
         </div>
         <div class="d-flex align-items-center">
            <input type="number" class="form-control text-center" id="quantityInput" value="1" style="width: 70px; margin-right:0.5rem;">
            <form action="" method="post">
               <input type="hidden" name="pname" value="<?php $product_detials['title'] ?>">
               <input type="hidden" name="pprice" value="<?php $product_detials['price'] ?>">
               <input type="hidden" name="psize" value="<?php $product_detials['title'] ?>">
               <input type="hidden" name="selected_size" id="selectedSizeInput">
               <input type="hidden" name="pname" value="<?php $product_detials['title'] ?>">
               <input type="hidden" name="pname" value="<?php $product_detials['title'] ?>">
               <button class="btn btn-primary me-3">Add to Cart</button>
            </form>
            <button class="btn btn-outline-secondary"><i class="bi bi-heart"></i> Add to Favorites</button>
         </div>
         <p class="mt-3"><small>Category: <?php echo $product_detials['category'];?></small></p>
         <p><small>Product Code: <?php echo $product_detials['product_code'];?></small></p>
      </div>
   </div>
</div>
<!-- End Single product -->
<?php
   // Include the footer file
   require_once 'footer.php';
   
   ?>
<script>
   function change_image(image){
      var container = document.getElementById("main-image");
      container.src = image.src;
}
document.addEventListener("DOMContentLoaded", function(event) {
});

$(document).ready(function() {
    $('#sizeSelect').change(function() {
        var selectedSize = $(this).val();
        $('#selectedSizeInput').val(selectedSize);
    });
});

</script>