<?php
// Connect to the database
$dsn = 'mysql:host=localhost;dbname=bathik';
$username = 'root';
$password = '';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
$pdo = new PDO($dsn, $username, $password, $options);

// Select all shops with images
$stmt = $pdo->query('SELECT store_id,storename,banner_img FROM stores');

if (isset($_GET['location'])) {
    $location = $_GET['location'];
    $stmt = $pdo->prepare('SELECT store_id, storename,banner_img FROM stores WHERE location = ?');
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




<section id="about-us" class=" mt-3">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <h2>About Us</h2>
        <p>Welcome to Batik Serendip! Our platform was inspired by a deep love and appreciation for Sri Lanka's rich cultural heritage of batik. We recognized the need to preserve this traditional art form and make it accessible to individuals across the globe.

Our team faced many challenges during the development process, including sourcing high-quality batik fabrics, collaborating with local artisans, and designing a user-friendly platform that showcased the beauty and versatility of batik.

Despite these obstacles, we remained committed to our mission of preserving Sri Lanka's cultural heritage and promoting sustainable practices in the production and distribution of batik. We partnered with local communities to source ethically-made batik fabrics and collaborated with skilled artisans to create unique, handcrafted products that celebrate the beauty and intricacy of batik.

At Batik Serendip, we are dedicated to providing our users with a seamless and enjoyable shopping experience. Our platform offers a wide range of batik products, from clothing and accessories to home decor and gifts. Our user-friendly interface allows customers to browse, filter, and purchase products with ease, and our secure payment gateway ensures that all transactions are safe and reliable.

We are passionate about sharing the beauty and artistry of batik with the world and are committed to making it accessible to individuals from all walks of life. Join us on our mission to preserve and celebrate Sri Lanka's cultural heritage, one beautiful batik product at a time.
</p>
      </div>
      <div class="col-lg-6">
        <img src="./img/aboutus.jpg" alt="Team Photo" class="img-fluid">
      </div>
    </div>
  </div>
</section>





<?php

// Include the footer file
require_once 'footer.php';

?>