<?php
// Connect to the database
$dsn = 'mysql:host=localhost;dbname=bathik';
$username = 'root';
$password = '';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
$pdo = new PDO($dsn, $username, $password, $options);

// Select all shops with images
$stmt = $pdo->query('SELECT title, location, image FROM shop WHERE image IS NOT NULL');


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
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
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

<!-- Slider started -->

<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <ol class="carousel-indicators">
    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/slide3.jpg" class="d-block w-100" alt="Slide 1">
    </div>
    <!-- <div class="carousel-item">
      <img src="img/slide2.jpg" class="d-block w-100" alt="Slide 2">
    </div> -->
    <!-- <div class="carousel-item">
      <img src="img/slide3.jpg" class="d-block w-100" alt="Slide 3">
    </div> -->
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </a>
</div>

<!-- Slider end -->


<!-- Search bar -->

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search your shop here..." aria-label="Search">
         <button class="btn btn-dark" type="submit">Search</button>
      </form>
    </div>
  </div>
</div>

<!-- Search bar end -->


<!-- Shops start  -->
<div class="container mt-5">
<div class="row">
  <?php
  while ($row = $stmt->fetch()) {
    
  ?>
  <div class="col-md-3">
    <div class="card border-0">
      <img src="uploads/<?php echo $row['image'] ?>" class="card-img-top" alt="...">
      <div class="card-body d-flex flex-column justify-content-center">
        <h5 class="card-title text-center"><?php echo $row['title']?></h5>
        <div class="rating text-center">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
      </div>
    </div>
  </div>
  <?php
  }
  ?>
  
  <!-- <div class="col-md-3">
    <div class="card border-0">
      <img src="img/shop3.png" class="card-img-top" alt="...">
      <div class="card-body d-flex flex-column justify-content-center">
        <h5 class="card-title text-center">Card Title</h5>
        <div class="rating text-center">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-md-3">
    <div class="card border-0">
      <img src="img/shop1.jpeg" class="card-img-top" alt="...">
      <div class="card-body d-flex flex-column justify-content-center">
        <h5 class="card-title text-center">Card Title</h5>
        <div class="rating text-center">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-md-3">
    <div class="card border-0">
      <img src="img/shop2.png" class="card-img-top" alt="...">
      <div class="card-body d-flex flex-column justify-content-center">
        <h5 class="card-title text-center">Card Title</h5>
        <div class="rating text-center">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-3">
    <div class="card border-0">
      <img src="img/shop5.jpeg" class="card-img-top" alt="...">
      <div class="card-body d-flex flex-column justify-content-center">
        <h5 class="card-title text-center">Card Title</h5>
        <div class="rating text-center">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-md-3">
    <div class="card border-0">
      <img src="img/shop6.jpeg" class="card-img-top" alt="...">
      <div class="card-body d-flex flex-column justify-content-center">
        <h5 class="card-title text-center">Card Title</h5>
        <div class="rating text-center">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-md-3">
    <div class="card border-0">
      <img src="img/shop7.jpeg" class="card-img-top" alt="...">
      <div class="card-body d-flex flex-column justify-content-center">
        <h5 class="card-title text-center">Card Title</h5>
        <div class="rating text-center">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-md-3">
    <div class="card border-0">
      <img src="img/shop8.webp" class="card-img-top" alt="...">
      <div class="card-body d-flex flex-column justify-content-center">
        <h5 class="card-title text-center">Card Title</h5>
        <div class="rating text-center">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
      </div>
    </div>
  </div> -->
</div>

</div>

<!-- Shops end -->

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