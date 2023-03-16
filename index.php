<?php
// Connect to the database
$dsn = 'mysql:host=localhost;dbname=bathik';
$username = 'root';
$password = '';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
$pdo = new PDO($dsn, $username, $password, $options);

// Select all shops with images
$stmt = $pdo->query('SELECT store_id,storename FROM stores');


?>
<?php

// Include the header file
require_once  'header.php';

?>


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
      <img src="img/shop1.jpeg" class="card-img-top" alt="...">
      <div class="card-body d-flex flex-column justify-content-center">
        <h5 class="card-title text-center"><a href="shop.php?id=<?php echo $row['store_id']?>"><?php echo $row['storename']?></a></h5>
        <!-- <a href="shop.php">shop</a> -->
        <!-- <div class="rating text-center">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div> -->
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


<?php

// Include the footer file
require_once 'footer.php';

?>

