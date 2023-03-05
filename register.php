<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect the form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    // Validate the form data
    $errors = array();
    if (empty($username)) {
        $errors[] = 'Username is required';
    }
    if (empty($email)) {
        $errors[] = 'Email is required';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email is not valid';
    }
    if (empty($phone)) {
        $errors[] = 'Phone is required';
    }
    if (empty($password)) {
        $errors[] = 'Password is required';
    }
    if (empty($confirm_password)) {
        $errors[] = 'Confirm Password is required';
    } else if ($password != $confirm_password) {
        $errors[] = 'Passwords do not match';
    }


    // Generate a secure hash of the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // If there are no errors, save the data to the database
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

        // Save the data to the database
        $sql = "INSERT INTO users (username, email, phone, password) VALUES ('$username', '$email', '$phone', '$hashed_password')";
        if ($conn->query($sql) === TRUE) {
            echo 'Registration successful';
        } else {
            echo 'Error: ' . $sql . '<br>' . $conn->error;
        }

        $conn->close();
    } else {
        // Display the errors
        foreach ($errors as $error) {
            echo $error . '<br>';
        }
    }
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
        <h1 class="hero-title">Create an account</h1>
      </div>
    </div>
  </div>
</section>

<!-- Hero section end -->

<!-- Register start -->

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
      <div class="card border-0">
        <div class="card-body">
          <h5 class="card-title text-center">Create an account</h5>
          <form method="POST" action="register.php">
    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="text" class="form-control" id="username" name="username">
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" id="email" name="email">
    </div>
    <div class="mb-3">
      <label for="phone" class="form-label">Phone</label>
      <input type="tel" class="form-control" id="phone" name="phone">
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" id="password" name="password">
    </div>
    <div class="mb-3">
      <label for="confirm-password" class="form-label">Confirm Password</label>
      <input type="password" class="form-control" id="confirm-password" name="confirm-password">
    </div>
    <div class="d-grid gap-2">
      <button type="submit" class="btn btn-lg btn-dark">Register</button>
    </div>
  </form>
        </div>
      </div>
    </div>
  </div>
</div>



<!-- Register end -->

<?php

// Include the footer file
require_once 'footer.php';

?>