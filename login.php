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

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Add Font Awesome CSS link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

    <link rel="stylesheet" href="css/main.css">

    <title>Welcome to bathik</title>
  </head>
  <body>
    <!-- Header started -->

<header class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="#">Logo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Shops</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Personalization</a>
        </li>
      </ul>
      <ul class="nav">
        <li class="nav-item">
          <a href="login.php"><i class="fas fa-user"></i></a>
        </li>
      </ul>
    </div>
  </div>
</header>

<!-- Header End -->

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
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
      <div class="card border-0">
        <div class="card-body">
          <h5 class="card-title text-center">Login to your account here</h5>
          <form form method="POST" action="login.php">
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email"  <?php if (isset($email_error)) echo 'title="' . $email_error . '"'; ?>>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" <?php if (isset($password_error)) echo 'title="' . $password_error . '"'; ?>>
            </div>
            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-dark btn-lg">Login</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Login form end -->


<!-- Footer start -->
<footer class="">
  <div class="container justify-content-center">
    <div class="row">
      <div class="col-sm-6 col-md-4 col-lg-2">
        <h5 class="text-center">VENDOR</h5>
        <ul class="list-unstyled text-center">
          <li><a href="#">Account</a></li>
          <li><a href="#">Register</a></li>
          <li><a href="#">Link 3</a></li>
        </ul>
      </div>
      <div class="col-sm-6 col-md-4 col-lg-2">
      <h5 class="text-center">INFORMATION</h5>
        <ul class="list-unstyled text-center">
          <li><a href="#">Home</a></li>
          <li><a href="#">About US</a></li>
          <li><a href="#">Location</a></li>
        </ul>
      </div>
      <div class="col-sm-6 col-md-4 col-lg-2">
      <h5 class="text-center">USEFULL LINKS</h5>
        <ul class="list-unstyled text-center">
          <li><a href="#">Link 1</a></li>
          <li><a href="#">Link 2</a></li>
          <li><a href="#">Link 3</a></li>
        </ul>
      </div>
      <div class="col-sm-6 col-md-4 col-lg-2">
      <h5 class="text-center">FOLLOW US ON</h5>
        <ul class="list-unstyled text-center">
          <li><a href="#">Link 1</a></li>
          <li><a href="#">Link 2</a></li>
          <li><a href="#">Link 3</a></li>
        </ul>
      </div>
      <div class="col-sm-6 col-md-4 col-lg-2">
      <h5 class="text-center">SECURE PAYMENT</h5>
        <ul class="list-unstyled text-center">
          <li><a href="#">Link 1</a></li>
          <li><a href="#">Link 2</a></li>
          <li><a href="#">Link 3</a></li>
        </ul>
      </div>
    </div>
  </div>
</footer>
<!-- Footer end -->




    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>