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
        <h1 class="hero-title">Buddhi Batiks</h1>
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
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="img/productImg.png" class="product-img" alt="Product Image" class="d-block w-100">
          </div>
          <div class="carousel-item">
            <img src="img/productImg.png" class="product-img" alt="Product Image" class="d-block w-100">
          </div>
          <div class="carousel-item">
            <img src="img/productImg.png" class="product-img" alt="Product Image" class="d-block w-100">
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
      <h2 class="fw-bold">Product Title</h2>
      <p class="lead">$99.99</p>
      <p>Description of the product goes here.</p>
      <div class="mb-3">
        <label for="sizeSelect" class="form-label">Size</label>
        <select class="form-select" id="sizeSelect">
          <option selected>Select size</option>
          <option value="small">Small</option>
          <option value="medium">Medium</option>
          <option value="large">Large</option>
        </select>
      </div>
      <button class="btn btn-primary me-3">Add to Cart</button>
      <button class="btn btn-outline-secondary"><i class="bi bi-heart"></i> Add to Favorites</button>
      <p class="mt-3"><small>Category: Category Name</small></p>
      <p><small>Product Code: 123456</small></p>
    </div>
  </div>
</div>


<!-- End Single product -->


<?php

// Include the footer file
require_once 'footer.php';

?>