<?php
session_start();

if (!isset($_SESSION['email'])) {
   // Redirect to the login page
   header("Location: ../vendor_login.php");
   exit();
}

// Connect to the database
$dsn = 'mysql:host=localhost;dbname=bathik';
$username = 'root';
$password = '';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
$pdo = new PDO($dsn, $username, $password, $options);

$shop = $_SESSION['store_id'];

// Select all shops with images
$stmt = $pdo->query("SELECT * FROM cart_order WHERE shop='$shop'");

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   // Get the selected action from the form data
   $action = $_POST['action'];
   $user_id = $_POST['userid'];
   $pid = $_POST['pid'];



   // Update the database with the new status
   $updateStatus = $pdo->prepare('UPDATE `cart_order` SET `status` = :status WHERE `user_id` = :user_id AND `id` = :product_id');
   $updateStatus->execute([
      'status' => $action,
      'user_id' => $user_id,
      // Replace with the actual user ID
      'product_id' => $pid, // Replace with the actual product ID
   ]);

   // Redirect the user back to the same page to prevent form resubmission
   header('Location: ' . $_SERVER['REQUEST_URI']);
   exit();
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
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
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
      require_once 'sidebar.php';
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
                                 placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
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
                     <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                        <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
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
                  <h1 class="h3 mb-0 text-gray-800">Orders</h1>
                  <button class="btn btn-primary" id="dl-pdf">Download PDF</button>
               </div>
               <!-- Content Row -->
               <div class="row">
                  <table class="table" id="orderTable">
                     <thead class="thead-dark">
                        <tr>
                           <th scope="col">Product name</th>
                           <th scope="col">Product price</th>
                           <th scope="col">Qty</th>
                           <th scope="col">Status</th>
                           <th scope="col">Selection</th>
                           <th scope="col">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        while ($row = $stmt->fetch()) {

                           ?>
                           <tr>
                              <td>
                                 <?php echo $row['product_name']; ?>
                              </td>
                              <td>
                                 <?php echo $row['product_price']; ?>
                              </td>
                              <td>
                                 <?php echo $row['qty']; ?>
                              </td>
                              <td>
                                 <?php echo $row['status']; ?>
                              </td>
                              <form action="orders.php" method="POST">
                                 <input type="hidden" name="userid" value="<?php echo $row['user_id']; ?>">
                                 <input type="hidden" name="pid" value="<?php echo $row['id']; ?>">
                                 <td>
                                    <select name="action" class="form-select" aria-label="Default select example">
                                       <option selected>Open this select menu</option>
                                       <option value="Pending">Pending</option>
                                       <option value="Processing">Processing</option>
                                       <option value="Completed">Completed</option>
                                    </select>
                                 </td>
                                 <td>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                 </td>
                              </form>
                           </tr>
                           <?php
                        }
                        ?>
                     </tbody>
                  </table>
               </div>
               <!-- Content Row -->
               <div class="row">
               </div>
               <!-- Content Row -->
               <div class="row">
                  <div class="col-lg-6 mb-4">
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
   <script src="js/html2pdf.bundle.min.js"></script>
   <script type="text/javascript">
      document.getElementById('dl-pdf').onclick = function () {
         var table = document.getElementById('orderTable');
         var tbody = table.getElementsByTagName('tbody')[0];

         // Remove the select option and action column from each row
         var rows = tbody.getElementsByTagName('tr');
         for (var i = 0; i < rows.length; i++) {
            var tdSelect = rows[i].getElementsByTagName('td')[4];
            tdSelect.innerHTML = '';
            var tdAction = rows[i].getElementsByTagName('td')[5];
            tdAction.innerHTML = '';
         }

         var opt = {
            margin: 1,
            filename: 'orders.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
         };
         html2pdf(table, opt);
      };

      // HTML canvas element to draw the chart
      var ctx = document.getElementById('myChart').getContext('2d');

      // Chart data
      var chartData = {
         labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
         datasets: [{
            label: 'Sales',
            data: [12, 19, 3, 5, 2, 3, 15],
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
         }]
      };

      // Chart options
      var chartOptions = {
         scales: {
            yAxes: [{
               ticks: {
                  beginAtZero: true
               }
            }]
         }
      };

      // Create the chart
      var myChart = new Chart(ctx, {
         type: 'bar',
         data: chartData,
         options: chartOptions
      });


   </script>
</body>

</html>