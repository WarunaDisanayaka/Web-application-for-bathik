<?php
// Connect to the database
$dsn = 'mysql:host=localhost;dbname=bathik';
$username = 'root';
$password = '';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
$pdo = new PDO($dsn, $username, $password, $options);

// Select all shops with images
$stmt = $pdo->query('SELECT store_id,storename FROM stores');

if (isset($_GET['location'])) {
    $location = $_GET['location'];
    $stmt = $pdo->prepare('SELECT store_id, storename FROM stores WHERE location = ?');
    $stmt->execute([$location]);
}

?>
<?php

// Include the header file
require_once 'header.php';

?>

<script>
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    // Geolocation is not supported by this browser
  }

  function showPosition(position) {
    // Get the latitude and longitude values
    var lat = position.coords.latitude;
    var lng = position.coords.longitude;

   
  }

</script>



<!-- Search bar -->

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <form class="d-flex" action="index.php" method="get">
        <input class="form-control me-2" type="search" name="location" placeholder="Search your shop here..." aria-label="Search">
        <button class="btn btn-dark" type="submit">Search</button>
      </form>
    </div>
  </div>
</div>

<!-- Search bar end -->


<!-- Shops start  -->
<div class="container mt-5 shop">
  <div class="row">
    <?php
    while ($row = $stmt->fetch()) {

        ?>
            <div class="col-md-3">
              <div class="card border-0">
                <img src="img/shop1.jpeg" class="card-img-top" alt="...">
                <div class="card-body d-flex flex-column justify-content-center">
                  <h5 class="card-title text-center"><a href="shop.php?id=<?php echo $row['store_id'] ?>"><?php echo $row['storename'] ?></a></h5>
                  <!-- <a href="shop.php">shop</a> -->
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


<?php

// Include the footer file
require_once 'footer.php';

?>