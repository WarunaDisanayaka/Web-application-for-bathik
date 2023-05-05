<?php
session_start();

if (isset($_SESSION['email'])) {
  // Redirect to the login page
  header("Location: my_account.php");
  exit();
} else {

}

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
      $_SESSION['userid'] = $row['id'];

      // Check user role and redirect accordingly
      if ($row['role'] == 'admin') {
        header('Location: dashboard');
      } else {
        header('Location: my_account.php');
      }
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
require_once 'header.php';

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
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
      <div class="card border-0">
        <div class="card-body">
          <h5 class="card-title text-center">Login to your account here</h5>
          <form form method="POST" action="login.php">
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email"  value="<?php echo isset($email) ? $email : ''; ?>">
               <p class="text" style="color:red;"> <?php echo $email_error ?></p>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" <?php if (isset($password_error))
                echo 'title="' . $password_error . '"'; ?>>
                <p class="text" style="color:red;"> <?php echo $password_error ?></p>
            </div>
            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-dark btn-lg">Login</button>
            </div>
            <div class="text-center mt-3">
              <p>Don't have an account? <a href="register.php">Register</a></p>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Login form end -->


<?php

// Include the footer file
require_once 'footer.php';

?>