<?php

// Include the header file
require_once  'header.php';

?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect the form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    // Validate username
  if (empty($username) || !preg_match('/^[a-zA-Z0-9_]{4,}$/', $username)) {
    $errors[] = 'Invalid username. Please enter a valid username with at least 4 characters.';
  }

  // Validate email
  if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Invalid email. Please enter a valid email address.';
  }

  // Validate phone
  if (empty($phone) || !preg_match('/^\d{10}$/', $phone)) {
    $errors[] = 'Invalid phone number. Please enter a 10-digit phone number.';
  }

  // Validate password
  if (empty($password) || !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password)) {
    $errors[] = 'Invalid password. Please enter a password with at least 8 characters, including at least one uppercase letter, one lowercase letter, one number, and one special character.';
  }

  // Validate confirm password
  if ($password !== $confirmPassword) {
    $errors[] = 'Passwords do not match. Please try again.';
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
        $sql = "INSERT INTO users (username, email, phone, password, role) VALUES ('$username', '$email', '$phone', '$hashed_password','user')";
        if ($conn->query($sql) === TRUE) {
             // Form submitted successfully, show SweetAlert message
    echo "<script>
    swal({
        title: 'Registration successful',
        text: 'Thank you for registering!',
        icon: 'success',
        button: 'OK'
    });
</script>";
        } else {
            //echo 'Error: ' . $sql . '<br>' . $conn->error;
            // Form submitted successfully, show SweetAlert message
    echo "<script>
    swal({
        title: 'Warning!',
        text: 'Something went wrong!',
        icon: 'warning',
        button: 'OK'
    });
</script>";
        }

        $conn->close();
    } else {
        // // Display the errors
        // foreach ($errors as $error) {
        //     echo $error . '<br>';
        // }
    }
}
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
<form method="POST" action="register.php">
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="username" name="username" value="<?php echo isset($username) ? $username : ''; ?>">
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
  </div>
  <div class="mb-3">
    <label for="phone" class="form-label">Phone</label>
    <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo isset($phone) ? $phone : ''; ?>">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password" value="<?php echo isset($password) ? $password : ''; ?>">
  </div>
  <div class="mb-3">
    <label for="confirm-password" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" id="confirm-password" name="confirm-password" value="<?php echo isset($confirm_password) ? $confirm_password : ''; ?>">
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