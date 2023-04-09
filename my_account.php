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
       $sql = "SELECT * FROM stores WHERE email = '$email'";
       $result = $conn->query($sql);
       if ($result->num_rows == 1) {
           // Verify the password
           $row = $result->fetch_assoc();
           if (password_verify($password, $row['password'])) {
               // Login successful
               $_SESSION['store_id'] = $row['store_id'];
               $_SESSION['email'] = $row['email'];
               $_SESSION['phone'] = $row['phone'];
               header('Location: vendordashboard');
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
            <h1 class="hero-title">Login to your Account</h1>
         </div>
      </div>
   </div>
</section>
<!-- Hero section end -->
<!-- Login form start -->
<div class="container mt-5">
   <ul class="nav nav-tabs">
      <li class="nav-item">
         <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Dashboard</button>
      </li>
      <li class="nav-item">
         <button class="nav-link" id="menu1-tab" data-bs-toggle="tab" data-bs-target="#menu1" type="button" role="tab" aria-controls="menu1" aria-selected="false">Orders</button>
      </li>
      <li class="nav-item">
         <button class="nav-link" id="menu2-tab" data-bs-toggle="tab" data-bs-target="#menu2" type="button" role="tab" aria-controls="menu2" aria-selected="false">Account details</button>
      </li>
      <li class="nav-item">
         <button class="nav-link" id="menu2-tab" data-bs-toggle="tab" data-bs-target="#menu2" type="button" role="tab" aria-controls="menu2" aria-selected="false">Logout</button>
      </li>
   </ul>
   <div class="tab-content">
      <div id="home" class="tab-pane fade show active" role="tabpanel" aria-labelledby="home-tab">
         <h3>Home</h3>
         <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ut blandit nisi. Donec auctor bibendum felis a lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
      </div>
      <div id="menu1" class="tab-pane fade" role="tabpanel" aria-labelledby="menu1-tab">
         <h3>Menu 1</h3>
         <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ut blandit nisi. Donec auctor bibendum felis a lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
      </div>
      <div id="menu2" class="tab-pane fade" role="tabpanel" aria-labelledby="menu2-tab">
         <h3>Menu 2</h3>
         <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ut blandit nisi. Donec auctor bibendum felis a lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas  </p>
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