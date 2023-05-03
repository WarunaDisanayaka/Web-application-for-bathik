<?php
session_start();

if (!isset($_SESSION['email'])) {
   // Redirect to the login page
   header("Location: login.php");
   exit();
}

 // Include the dbconnection file
 require_once  'db_connection.php';


 $userId=$_SESSION['userid'];

   $myAccount="SELECT * FROM users WHERE id='$userId'";
   $result=$conn->query($myAccount);
   $row = $result->fetch_assoc();

   // Order
   $orders="SELECT * FROM cart_order WHERE user_id='$userId'";
   $query=$conn->query($orders);
  
   // Design orders
   $DesignOrders="SELECT * FROM design_orders WHERE user_id='$userId'";
   $query2=$conn->query($DesignOrders);
   
   ?>
<?php
   // Include the header file
   require_once  'header.php';
   
   ?>
<!-- Hero section start-->
<section class="hero" style="background-image: url('img/hero.png');">
   <div class="container">
      <div class="row align-items-center">
         <div class="col-lg-6">
            <h1 class="hero-title">My Account</h1>
         </div>
      </div>
   </div>
</section>
<!-- Hero section end -->
<!-- Login form start -->
<div class="container mt-5 mb-5">
   <ul class="nav nav-tabs mb-5">
      <li class="nav-item">
         <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Dashboard</button>
      </li>
      <li class="nav-item">
         <button class="nav-link" id="menu1-tab" data-bs-toggle="tab" data-bs-target="#menu1" type="button" role="tab" aria-controls="menu1" aria-selected="false">Orders</button>
      </li>
      <li class="nav-item">
         <button class="nav-link" id="menu1-tab" data-bs-toggle="tab" data-bs-target="#menu3" type="button" role="tab" aria-controls="menu3" aria-selected="false">Design Orders</button>
      </li>
      <li class="nav-item">
         <button class="nav-link" id="menu2-tab" data-bs-toggle="tab" data-bs-target="#menu2" type="button" role="tab" aria-controls="menu2" aria-selected="false">Messages</button>
      </li>
      <li class="nav-item">
         <a href="logout.php"><button class="nav-link" id="menu2-tab" data-bs-toggle="tab" data-bs-target="#menu2" type="button" role="tab" aria-controls="menu2" aria-selected="false">Logout</button></a>
      </li>
   </ul>
   <div class="tab-content">
      <div id="home" class="tab-pane fade show active" role="tabpanel" aria-labelledby="home-tab">
         <h3>Dashboard</h3>
         <p>Hi welcome <?php echo $row['username']?> </p>
      </div>
      <div id="menu1" class="tab-pane fade" role="tabpanel" aria-labelledby="menu1-tab">
         <h3>Orders</h3>
         <div class="container-fluid">
                  <!-- Content Row -->
                  <div class="row">
                     <table class="table">
                        <thead class="thead-dark">
                           <tr>
                              <th scope="col">Product name</th>
                              <th scope="col">Product price</th>
                              <th scope="col">Qty</th>
                              <th scope="col">Status</th>
                           </tr>
                        </thead>
                        <tbody>
                        <?php
                              while ($order=$query->fetch_assoc()) {
                                  
                           ?>
                           <tr>
                              <td><?php echo $order['product_name'];?></td>
                              <td><?php echo $order['product_price'];?></td>
                              <td><?php echo $order['qty'];?></td>
                              <td><?php echo $order['status'];?></td>
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
      </div>
      <div id="menu3" class="tab-pane fade" role="tabpanel" aria-labelledby="menu1-tab">
         <h3>Design Orders</h3>
         <div class="container-fluid">
                  <!-- Content Row -->
                  <div class="row">
                     <table class="table">
                        <thead class="thead-dark">
                           <tr>
                              <th scope="col">Design</th>
                              <th scope="col">Product price</th>
                              <th scope="col">Status</th>
                           </tr>
                        </thead>
                        <tbody>
                        <?php
                              while ($orderDesign=$query2->fetch_assoc()) {    
                           ?>
                           <tr>
                              <td><img src="<?php echo $orderDesign['design'];?>" style="width:250px;height:200px;" alt="" srcset=""></td>
                              <td><?php echo $orderDesign['price'];?></td>
                              <td><?php echo $orderDesign['status'];?></td>
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
      </div>
      <div id="menu2" class="tab-pane fade" role="tabpanel" aria-labelledby="menu2-tab">
      <li class="d-flex justify-content-between mb-4">
                                   <div class="card w-100">
                                      <div class="card-header d-flex justify-content-between p-3">
                                         <p class="fw-bold mb-0"></p>
                                      </div>
                                      <div class="card-body">
                                         <p class="mb-0">
                                            
                                         </p>
                                      </div>
                                      <a class="ms-3 float-right" href="#!" data-toggle="modal" data-target="#send-message-modal">
  <i class="fas fa-paper-plane"></i>
</a>

<!-- Modal -->
<div class="modal fade" id="send-message-modal" tabindex="-1" aria-labelledby="send-message-modal-label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="send-message-modal-label">Send Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="message.php" method="POST">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name" value="John Doe">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text" rows="3"></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Send</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

                                   </div>
                                </li>
      </div>
      <div id="menu2" class="tab-pane fade" role="tabpanel" aria-labelledby="menu2-tab">
         <h3>Menu </h3>
         <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ut blandit nisi. Donec auctor bibendum felis a lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas  </p>
      </div>
   </div>
</div>
<!-- Login form end -->
<?php
   // Include the footer file
   require_once 'footer.php';
   
   ?>