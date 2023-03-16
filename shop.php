<?php
   // Include the header file
   require_once  'header.php';
// Connect to the database
$dsn = 'mysql:host=localhost;dbname=bathik';
$username = 'root';
$password = '';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
$pdo = new PDO($dsn, $username, $password, $options);



   if (isset($_GET['id'])) {
      $store_id = $_GET['id'];
      // Select all shops products
      $stmt = $pdo->query("SELECT * FROM `products` WHERE vendor_id='$store_id'");  
      
   }
   
   ?>
<!-- Hero section start-->
<section class="hero" style="background-image: url('img/hero.png');">
   <div class="container">
      <div class="row align-items-center">
         <div class="col-lg-6">
            <h1 class="hero-title">Buddhi batik</h1>
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
                  <div class="mb-3">
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
                  </div>
                  <div class="mb-3">
                     <label for="color"><h4>Materials</h4></label>
                     <div>
                        <input type="checkbox" id="red">
                        <label for="red" class="form-check-label">Cotton</label>
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
            </div>
         </div>
      </div>
      <!-- Product filter end -->
      <!-- Product List -->
      <div class="col-lg-9 products">
         <div class="row">
            <div class="col-lg-3 mb-4">
               <div class="card border-0">
                  <img src="https://via.placeholder.com/400x400" alt="Product Image" class="card-img-top">
                  <div class="card-body">
                     <h6 class="card-title">Product Name</h6>
                  </div>
               </div>
            </div>
            <div class="col-lg-3 mb-4">
               <div class="card border-0">
                  <img src="https://via.placeholder.com/400x400" alt="Product Image" class="card-img-top">
                  <div class="card-body">
                    <h6 class="card-title">Product Name</h6>
                     
                  </div>
               </div>
            </div>
            <div class="col-lg-3 mb-4">
               <div class="card border-0">
                  <img src="https://via.placeholder.com/400x400" alt="Product Image" class="card-img-top">
                  <div class="card-body">
                    <h6 class="card-title">Product Name</h6>
                    
                  </div>
               </div>
            </div>
            <div class="col-lg-3 mb-4">
               <div class="card border-0">
                  <img src="https://via.placeholder.com/400x400" alt="Product Image" class="card-img-top">
                  <div class="card-body">
                    <h6 class="card-title">Product Name</h6>
                     
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php
   // Include the footer file
   require_once 'footer.php';
   
   ?>