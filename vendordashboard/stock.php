<?php
   session_start();
   
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      $pdo = new PDO("mysql:host=localhost;dbname=bathik", "root", "");

$product_id = $_POST['product-category'];
$size = $_POST['product-size'];

// Prepare the SQL statement
$stmt = $pdo->prepare("SELECT quantity FROM product_quantity WHERE product_id = ? AND size = ?");

// Execute the statement
$stmt->execute([$product_id, $size]);

// Fetch the result
$result = $stmt->fetch();

// Check if a quantity has already been added for the product and size
if ($result) {
    $quantity_added = $result['quantity'];
    echo "Quantity $quantity_added has already been added for product $product_id and size $size.";
} else {
    echo "No quantity has been added for product $product_id and size $size.";
}
      
      // Validate the form inputs
      $errors = [];
      if (empty($_POST['product-category'])) {
          $errors[] = "Please select a product";
      }
      if (empty($_POST['product-size'])) {
          $errors[] = "Please select at least one size";
      }
      if (empty($_POST['product-qty'][0]) && empty($_POST['product-qty'][1]) && empty($_POST['product-qty'][2])) {
          $errors[] = "Please enter at least one quantity";
      }
      
      // Check if there are any validation errors
      if (!empty($errors)) {
         
      } else {
          // Connect to the database
          $pdo = new PDO("mysql:host=localhost;dbname=bathik", "root", "");
      
          // Prepare the SQL statement
          $stmt = $pdo->prepare("INSERT INTO product_quantity (product_id, size, quantity) VALUES (?, ?, ?)");
      
          // Get the product ID
          $product_id = $_POST['product-category'];
      
          // Loop through the selected sizes and quantities
          $sizes = $_POST['product-size'];
          $quantities = $_POST['product-qty'];
          foreach ($sizes as $key => $size) {
              $quantity = (int)$quantities[$key];
              if ($quantity > 0) {
                  // Insert the data into the database
                  $stmt->execute([$product_id, $size, $quantity]);
              }
          }
      
          // Display a success message
          echo "<p>Product quantities have been added successfully.</p>";
      }
   }
   // Connect to the database
$dsn = 'mysql:host=localhost;dbname=bathik';
$username = 'root';
$password = '';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
$pdo = new PDO($dsn, $username, $password, $options);

$stmtproducts = $pdo->query('SELECT id, title FROM products');

   
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <title></title>
      <!-- Custom fonts for this template-->
      <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
      <link
         href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
         rel="stylesheet">
      <!-- Custom styles for this template-->
      <link href="css/sb-admin-2.min.css" rel="stylesheet">
      <!-- Sweet alert CDN -->
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <!-- CSS -->
      <link rel="stylesheet" href="css/main.css">
   </head>
   <body id="page-top">
      <!-- Page Wrapper -->
      <div id="wrapper">
         <!-- Sidebar -->
         <?php
            require_once  'sidebar.php';
            ?>
         <!-- End Sidebar -->
         <!-- Content Wrapper -->
         <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
               <!-- Topbar -->
               <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                  <!-- Sidebar Toggle (Topbar) -->
                  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                  <i class="fa fa-bars"></i>
                  </button>
                  <!-- Topbar Navbar -->
                  <ul class="navbar-nav ml-auto">
                     <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                     <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                           aria-labelledby="searchDropdown">
                           <form class="form-inline mr-auto w-100 navbar-search">
                              <div class="input-group">
                                 <input type="text" class="form-control bg-light border-0 small"
                                    placeholder="Search for..." aria-label="Search"
                                    aria-describedby="basic-addon2">
                                 <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                    </button>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </li>
                     <div class="topbar-divider d-none d-sm-block"></div>
                     <!-- Nav Item - User Information -->
                     <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                        <img class="img-profile rounded-circle"
                           src="img/undraw_profile.svg">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                           aria-labelledby="userDropdown">
                           <a class="dropdown-item" href="#">
                           <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                           Profile
                           </a>
                           <a class="dropdown-item" href="#">
                           <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                           Settings
                           </a>
                           <a class="dropdown-item" href="#">
                           <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                           Activity Log
                           </a>
                           <div class="dropdown-divider"></div>
                           <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                           <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                           Logout
                           </a>
                        </div>
                     </li>
                  </ul>
               </nav>
               <!-- End of Topbar -->
               <!-- Begin Page Content -->
               <div class="container-fluid">
                  <!-- Page Heading -->
                  <div class="d-sm-flex align-items-center justify-content-between mb-4">
                     <h1 class="h3 mb-0 text-gray-800">Add Stock</h1>
                  </div>
                  <div class="row">
                  </div>
                  <!-- Content Row -->
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
                     <div class="col-lg-6 mb-4">
                        <form method="POST" action="stock.php">
                                       
                           <div class="form-group">
                              <label for="product-category">Product</label>
                              <select class="form-control" id="product-category" name="product-category">
                                 <option selected>Choose product...</option>
                                 <?php
                           while ($row = $stmtproducts->fetch()) {
                        ?>   
                                 <option value="<?php echo $row["id"]?>"><?php echo $row["id"]." ".$row["title"]?></option>
                                 <?php
                           }
                           ?>
                              </select>
                           </div>
                          
                           
                           <div class="form-group">
                              <label for="product-size">Size & Quantity</label>
                              <div class="form-check">
                                 <input class="form-check-input" type="checkbox" id="product-size-small" name="product-size[]" value="small">
                                 <label class="form-check-label" for="product-size-small">
                                 Small:
                                 </label>
                                 <input type="number" class="form-control" id="product-qty-small" name="product-qty[]" placeholder="Enter quantity">
                              </div>
                              <div class="form-check">
                                 <input class="form-check-input" type="checkbox" id="product-size-medium" name="product-size[]" value="medium">
                                 <label class="form-check-label" for="product-size-medium">
                                 Medium:
                                 </label>
                                 <input type="number" class="form-control" id="product-qty-medium" name="product-qty[]" placeholder="Enter quantity">
                              </div>
                              <div class="form-check">
                                 <input class="form-check-input" type="checkbox" id="product-size-large" name="product-size[]" value="large">
                                 <label class="form-check-label" for="product-size-large">
                                 Large:
                                 </label>
                                 <input type="number" class="form-control" id="product-qty-large" name="product-qty[]" placeholder="Enter quantity">
                              </div>
                           </div>
                           <button type="submit" class="btn btn-primary">Add Product</button>
                        </form>
                     </div>
                  </div>
               </div>
               <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
               <div class="container my-auto">
                  <div class="copyright text-center my-auto">
                     <span>Copyright &copy; Your Website 2021</span>
                  </div>
               </div>
            </footer>
            <!-- End of Footer -->
         </div>
         <!-- End of Content Wrapper -->
      </div>
      <!-- End of Page Wrapper -->
      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
      </a>
      <!-- Logout Modal-->
      <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
               </div>
               <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
               <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                  <a class="btn btn-primary" href="login.html">Logout</a>
               </div>
            </div>
         </div>
      </div>
      <!-- Bootstrap core JavaScript-->
      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <!-- Core plugin JavaScript-->
      <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
      <!-- Custom scripts for all pages-->
      <script src="js/sb-admin-2.min.js"></script>
      <!-- Page level plugins -->
      <script src="vendor/chart.js/Chart.min.js"></script>
      <!-- Page level custom scripts -->
      <script src="js/demo/chart-area-demo.js"></script>
      <script src="js/demo/chart-pie-demo.js"></script>
      <script>
         function previewImage(input) {
           if (input.files && input.files[0]) {
             var reader = new FileReader();
             reader.onload = function (e) {
               $('#preview').attr('src', e.target.result).show();
             };
             reader.readAsDataURL(input.files[0]);
           }
         }
      </script>
   </body>
</html>