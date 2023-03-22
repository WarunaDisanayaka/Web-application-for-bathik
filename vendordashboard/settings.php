<?php
   session_start();
   
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
       // Collect the form data
       $banner_img = $_FILES['image'];
       $vendor_id = $_POST['vendor_id'];
   
   // Validate image
   $allowed_extensions = array('jpg', 'jpeg', 'png');
   $file_extension = pathinfo($banner_img['name'], PATHINFO_EXTENSION);
   if (empty($banner_img['name']) || !in_array($file_extension, $allowed_extensions)) {
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

           // Move the uploaded document to the upload path
   $uploadPath = 'uploads/'; // set your upload path here
   $filename = uniqid() . '_' . $banner_img['name'];
   $destination = $uploadPath . $filename;
   if (!move_uploaded_file($banner_img['tmp_name'], $destination)) {
       $errors[] = 'Failed to upload the document. Please try again.';
   }
   
   
          // Prepare the SQL statement
          
   $stmt = $conn->prepare("UPDATE stores SET banner_img = ? WHERE store_id = ?");
//    "UPDATE stores SET banner_img = ? WHERE store_id = ?";
   // Bind the parameters
   $stmt->bind_param("sd", $destination, $vendor_id);
   
   
          // Read the image data
   $image_data = file_get_contents($banner_img['tmp_name']);
   
   
           // Execute the statement
           if ($stmt->execute() === TRUE) {
               // Upload the image to the server
//    $target_dir = "/Applications/XAMPP/xamppfiles/htdocs/Web-application-for-bathik/uploads";
//    $target_file = $target_dir . basename($banner_img['name']);
//    move_uploaded_file($banner_img['tmp_name'], $target_file);

   
   
   
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
                     <h1 class="h3 mb-0 text-gray-800">Settings</h1>
                  </div>
                  <!-- Content Row -->
                  <div class="row">
                  </div>
                  <!-- Content Row -->
                  <div class="row">
                  </div>
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
                  <!-- Content Row -->
                  <div class="row">
                     <div class="col-lg-6 mb-4">
                        <!-- Display form with error/success message -->
                        <form method="POST" action="settings.php" enctype="multipart/form-data">
                           <!-- <div class="form-group">
                              <label for="title">Shop Name</label>
                              <input type="text" class="form-control" id="title" name="title" placeholder="Enter shop name" >
                           </div> -->
                           <div class="form-group">
                              <label for="image">Banner Image</label>
                              <div class="custom-file">
                                 <!-- <input type="file" class="form-control-file" id="image" name="image" > -->
                                 <input class="form-control-file" type="file" id="image" name="image" onchange="previewImage(this);">
                                 <img id="preview" class="preview-img" src="#" alt="Preview" style="display:none; margin-left:5rem;">
                                 <!-- <label class="custom-file-label" for="image">Choose file</label> -->
                                 <input type="hidden" name="vendor_id" value=<?php echo $_SESSION['store_id']; ?>>
                              </div>
                           </div>
                           <div class="form-group">
                              <label for="image">Thumbnail Image</label>
                              <div class="custom-file">
                                 <!-- <input type="file" class="form-control-file" id="image" name="image" > -->
                                 <input class="form-control-file" type="file" id="image" name="imagethumb" onchange="previewImageThumb(this);">
                                 <img id="previewthumb" class="preview-img" src="#" alt="Preview" style="display:none; margin-left:5rem;">
                                 <!-- <label class="custom-file-label" for="image">Choose file</label> -->
                                 <input type="hidden" name="vendor_id" value=<?php echo $_SESSION['store_id']; ?>>
                              </div>
                           </div>
                           <button type="submit" class="btn btn-primary">Update</button>
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

function previewImageThumb(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $('#previewthumb').attr('src', e.target.result).show();
    };
    reader.readAsDataURL(input.files[0]);
  }
}
</script>
   </body>
</html>