<?php
   session_start();
   
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
       // Collect the form data
       $product_title = $_POST['product-title'];
       $product_description = $_POST['product-description'];
       $product_price = $_POST['product-price'];
       $product_category = $_POST['product-category'];
       $product_code = $_POST['product-code'];
       $product_images = $_FILES['product-images'];
       $product_images2 = $_FILES['product-images2'];
       $product_images3 = $_FILES['product-images3'];
       $vendor_id = $_POST['vendor_id'];
   
       // Validate title
   if (empty($product_title)) {
       $errors[] = 'Please enter a product title.';
   }
   
   // Validate price
   if (empty($product_price) || !is_numeric($product_price)) {
       $errors[] = 'Invalid price. Please enter a valid price.';
   }
   
   // Validate description
   if (empty($product_description)) {
       $errors[] = 'Please enter a product description.';
   }
   
   
   // Validate category
   if (empty($product_category) || $product_category == 'Choose category...') {
       $errors[] = 'Please select a product category.';
   }
   
   
   // Validate code
   if (empty($product_code)) {
       $errors[] = 'Please enter a product code.';
   }
  
   
   
   // Validate image
   $allowed_extensions = array('jpg', 'jpeg', 'png');
   $file_extension = pathinfo($product_images['name'], PATHINFO_EXTENSION);
   if (empty($product_images['name']) || !in_array($file_extension, $allowed_extensions)) {
       $errors[] = 'Invalid image. Please choose a valid image file (jpg, jpeg, or png) with a maximum size of 2MB.';
   } 
   
       // If there are no errors, save the data to the database and upload the image
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
   
   $target_dir = "uploads/";
   $target_file = $target_dir . basename($product_images['name']);

   $target_dir = "uploads/";
   $target_file2 = $target_dir . basename($product_images2['name']);

   $target_dir = "uploads/";
   $target_file3 = $target_dir . basename($product_images3['name']);

          // Prepare the SQL statement
   $stmt = $conn->prepare("INSERT INTO products (title, price, product_description, category, product_code, image1,image2,image3,vendor_id) VALUES (?, ?, ?, ?, ?, ?,?,?,?)");
   
   // Bind the parameters
   $stmt->bind_param("sdsssssss", $product_title, $product_price, $product_description, $product_category, $product_code, $target_file,$target_file2,$target_file3,$vendor_id);
   
   
          // Read the image data
   $image_data = file_get_contents($product_images['tmp_name']);
   
   
           // Execute the statement
           if ($stmt->execute() === TRUE) {
               // Upload the image to the server
   
   move_uploaded_file($product_images['tmp_name'], $target_file);
   move_uploaded_file($product_images['tmp_name'], $target_file2);
   move_uploaded_file($product_images['tmp_name'], $target_file3);
   
   
               // Form submitted successfully, show SweetAlert message
               echo "<script>
               swal({
                   title: 'Product added successfully',
                   text: 'Your product has been added to the database!',
                   icon: 'success',
                   button: 'OK'
               });
               </script>";
           } else {
               // Form submission failed, show SweetAlert message
               echo 'Error: ' . $conn->error;
               echo "<script>
               swal({
                   title: 'Warning!',
                   text: 'Something went wrong!',
                   icon: 'warning',
                   button: 'OK'
               });
               </script>";
           }
   
           // Close the statement and the database connection
           $stmt->close();
           $conn->close();
       } else {
           // // Display the errors
           // foreach ($errors as $error) {
           //     echo $error . '<br>';
           // }
       }
   }
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
                     <h1 class="h3 mb-0 text-gray-800">Add Product</h1>
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
                        <form method="POST" action="add_product.php" enctype="multipart/form-data">
                           <div class="form-group">
                              <label for="product-title">Product Title</label>
                              <input type="text" class="form-control" id="product-title" name="product-title" placeholder="Enter product title">
                           </div>
                           <div class="form-group">
                              <label for="product-price">Price</label>
                              <input type="number" class="form-control" id="product-price" name="product-price" placeholder="Enter price">
                           </div>
                           <div class="form-group">
                              <label for="product-description">Description</label>
                              <textarea class="form-control" id="product-description" name="product-description" rows="3" placeholder="Enter description"></textarea>
                           </div>
                           <div class="form-group">
                              <label for="product-category">Category</label>
                              <select class="form-control" id="product-category" name="product-category">
                                 <option selected>Choose category...</option>
                                 <option>Clothing</option>
                                 <option>Shoes</option>
                                 <option>Accessories</option>
                              </select>
                           </div>
                           <div class="form-group">
                              <label for="product-code">Product Code</label>
                              <input type="text" class="form-control" id="product-code" name="product-code" placeholder="Enter product code">
                           </div>
                           <div class="form-group">
                              <label for="product-images">Image 1</label>
                              <input class="form-control-file" type="file" id="product-images" name="product-images" onchange="previewImage(this);">
                              <img id="preview" class="preview-img" src="#" alt="Preview" style="display:none;">
                           </div>
                           <div class="form-group">
                              <label for="product-images">Image 2</label>
                              <input class="form-control-file" type="file" id="product-images2" name="product-images2" onchange="previewImage(this);">
                              <img id="preview" class="preview-img" src="#" alt="Preview" style="display:none;">
                           </div>
                           <div class="form-group">
                              <label for="product-images">Image 3</label>
                              <input class="form-control-file" type="file" id="product-images3" name="product-images3" onchange="previewImage(this);">
                              <img id="preview" class="preview-img" src="#" alt="Preview" style="display:none;">
                           </div>
                           
                           <input type="hidden" name="vendor_id" value=<?php echo $_SESSION['store_id']; ?>>
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
                  <a class="btn btn-primary" href="logout.php">Logout</a>
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