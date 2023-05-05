<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
// Include the header file
require_once 'header.php';
// Connect to the database
// $dsn = 'mysql:host=localhost;dbname=bathik';
// $username = 'root';
// $password = '';
// $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
// $pdo = new PDO($dsn, $username, $password, $options);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bathik";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}


// $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);


if (isset($_POST['filter'])) {
   // Get the selected materials from the checkboxes
   $materials = isset($_POST['materials']) ? $_POST['materials'] : array();

   // Get the selected price range
   $min_price = isset($_POST['min_price']) ? $_POST['min_price'] : 0;
   $max_price = isset($_POST['max_price']) ? $_POST['max_price'] : 5000;
   $id = $_SESSION['shop'];
   // $shopname = $_POST['shopname'];



   // Select all data from the product table
   $sql = "SELECT * FROM products WHERE vendor_id='$id'";
   // $stmt = $pdo->prepare($sql);
   // $stmt->execute();
   // // Fetch the data as an associative array
   // $rows = $stmt->fetch(PDO::FETCH_ASSOC);
   // Execute the query
   $result = $conn->query($sql);
   $products = [];
   // Check if the query was successful
   if ($result) {
      // Fetch all rows of the result as an associative array
      $rows = $result->fetch_all(MYSQLI_ASSOC);
      $count = 0;
      // Do something with the data, for example:
      foreach ($rows as $row) {
         foreach ($materials as $m) {
            if ($row['fabric'] == $m && $row['price'] >= $min_price && $row['price'] <= $max_price) {
               $product = [
                  'id' => $row['id'],
                  'title' => $row['title'],
                  'price' => $row['price'],
                  'product_description' => $row['product_description'],
                  'category' => $row['category'],
                  'fabric' => $row['fabric'],
                  'product_code' => $row['product_code'],
                  'image1' => $row['image1'],
                  'image2' => $row['image2'],
                  'image3' => $row['image3'],
                  'vendor_id' => $row['vendor_id'],
                  'created_at' => $row['created_at']
               ];
               $products[$count] = $product;
               $count = $count + 1;
            }
         }

      }
   } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
   }




}


// if (isset($_POST['filter'])) {
//    // code to execute when the filter button is clicked
//    // get selected materials and price range from the form
//    $materials = isset($_POST['materials']) ? $_POST['materials'] : array();
//    $min_price = $_POST['min_price'];
//    $max_price = $_POST['max_price'];

//    // build SQL query to filter products
//    $sql = "SELECT * FROM products WHERE fabric IN (" . str_repeat('?,', count($materials) - 1) . "?) AND price BETWEEN ? AND ?";

//    // prepare the query statement
//    $stmt = $pdo->prepare($sql);

//    // bind the parameters to the statement
//    $params = array_merge($materials, array($min_price, $max_price));
//    $stmt->execute($params);

//    // fetch the filtered products and display them
//    if ($stmt->rowCount() > 0) {
//       echo "<table>";
//       echo "<tr><th>ID</th><th>Title</th><th>Price</th><th>Description</th><th>Category</th><th>Fabric</th><th>Code</th><th>Image1</th><th>Image2</th><th>Image3</th><th>Vendor ID</th></tr>";
//       while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//          echo "<tr><td>" . $row["id"] . "</td><td>" . $row["title"] . "</td><td>" . $row["price"] . "</td><td>" . $row["product_description"] . "</td><td>" . $row["category"] . "</td><td>" . $row["fabric"] . "</td><td>" . $row["product_code"] . "</td><td>" . $row["image1"] . "</td><td>" . $row["image2"] . "</td><td>" . $row["image3"] . "</td><td>" . $row["vendor_id"] . "</td></tr>";
//       }
//       echo "</table>";
//    } else {
//       echo "No products found.";
//    }
// } else {
//    // code to execute when the filter button is not clicked
//    // ...
// }

// if (isset($_GET['id'])) {
//    $store_id = $_GET['id'];
//    $_SESSION['shop'] = $_GET['id'];
//    // Select all shops products
//    $stmt = $pdo->query("SELECT * FROM `products` WHERE vendor_id='$store_id'");
//    // Select store
//    $store = $pdo->query("SELECT storename FROM stores WHERE store_id='$store_id'");
//    $storeName = $store->fetch();
//    // Ratings
//    $ratings = $pdo->query("SELECT * FROM ratings WHERE shop='$store_id'");
//    // $rate = $ratings->fetch();
// }

// // Check if the form was submitted
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//    // Get the form data
//    $shop = $_POST['shop'];
//    $review = $_POST['review'];
//    $rating = $_POST['rating'];

//    // Validate the form data
//    // Validate review
//    if (empty($review) || !preg_match('/^[a-zA-Z0-9_ ]{4,}$/', $review)) {
//       echo '<script>
//             alert("Enter your review")
//             window.location.href = "shop.php?id=' . $_SESSION['shop'] . '";
//          </script>';

//    }

//    // Validate star rating
//    if (empty($rating) || !preg_match('/^\d{1}$/', $rating)) {
//       echo '<script>
//       alert("Please add your rating")
//       window.location.href = "shop.php?id=' . $_SESSION['shop'] . '";
//       </script>';
//    }

//    // Save the form data to the database
//    // If there are no errors, save the data to the database
//    if (empty($errors)) {
//       // Connect to the database
//       $host = 'localhost';
//       $user = 'root';
//       $pwd = '';
//       $dbname = 'bathik';
//       $conn = new mysqli($host, $user, $pwd, $dbname);
//       if ($conn->connect_error) {
//          die('Connection failed: ' . $conn->connect_error);
//       }

//       // Save the data to the database
//       $sql = "INSERT INTO ratings (shop, rating, review) VALUES ('$shop', '$rating', '$review')";
//       if ($conn->query($sql) === TRUE) {
//          // Form submitted successfully, show SweetAlert message
//          echo "<script>
//       swal({
//          title: 'Review added successful',
//          text: 'Thank you for your review!',
//          icon: 'success',
//          button: 'OK',
//       }).then(function() {
//          window.location.href = 'shop.php?id=" . $_SESSION["shop"] . "';
//       });
//       </script>";
//       } else {
//          //echo 'Error: ' . $sql . '<br>' . $conn->error;
//          // Form submitted successfully, show SweetAlert message
//          echo "<script>
//       swal({
//          title: 'Warning!',
//          text: 'Something went wrong!',
//          icon: 'warning',
//          button: 'OK'
//       });
//       </script>";
//       }

//       $conn->close();
//    } else {
//       // // Display the errors
//       // foreach ($errors as $error) {
//       //     echo $error . '<br>';
//       // }
//    }

// }

?>
<!-- Hero section start-->
<section class="hero" style="background-image: url('img/hero.png');">
   <div class="container">
      <div class="row align-items-center">
         <div class="col-lg-6">
            <h1 class="hero-title"><?php echo $shopname; ?></h1>
         </div>
      </div>
   </div>
</section>
<!-- Hero section end -->
<!-- Product filter -->
<div class="container-fluid shop-content">
   <div class="row">
      <!-- Sidebar -->
      <div class="col-lg-3">
         <div class="card mb-3 border-0">
            <div class="card-body">
            <form action="filter_products.php" method="post">
                  <input type="hidden" name="id" value="<?php echo $id ?>">
                  <input type="hidden" name="shopname" value="<?php echo $storeName; ?>">
                  <div class="mb-3">
                     <label for="color">
                        <h4>Materials</h4>
                     </label>
                     <div>
                        <input type="checkbox" id="linen" name="materials[]" value="linen">
                        <label for="linen" class="form-check-label">Linen</label>
                     </div>
                     <div>
                        <input type="checkbox" id="cotton" name="materials[]" value="cotton">
                        <label for="cotton" class="form-check-label">Cotton</label>
                     </div>
                     <div>
                        <input type="checkbox" id="rayon" name="materials[]" value="rayon">
                        <label for="rayon" class="form-check-label">Rayon</label>
                     </div>
                     <div>
                        <input type="checkbox" id="silk" name="materials[]" value="silk">
                        <label for="silk" class="form-check-label">Silk</label>
                     </div>
                  </div>
                  <div>
                     <label for="price">Price Range</label>
                     <input type="range" class="form-range" id="min_price" name="min_price" min="0" max="1000" step="50" value="0">
                     <input type="range" class="form-range" id="max_price" name="max_price" min="0" max="100000" step="50" value="100000">
                  </div>
                  <p id="price-output">Rs 0 - Rs 1000</p>

                  <input type="submit" value="Filter" name="filter" class="btn btn-primary">
               </form>
               <div class="mb-3">
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
                  <form action="filter_products.php" method="POST">
                     <label for="textArea">
                        <h4>Your Comment</h4>
                     </label>
                     <textarea class="form-control" name="review" id="textArea" rows="3"></textarea>
               </div>
               <div class="mb-3">
                  <label for="star-rating">
                     <h4>Your Rating</h4>
                  </label>
                  <input type="hidden" name="shop" value="<?php echo $store_id; ?>">
                  <input type="hidden" name="rating" id="rating-value">
                  <div class="rating">
                     <i class="fa fa-star fa-1x star-btn" data-value="1"></i>
                     <i class="fa fa-star fa-1x star-btn" data-value="2"></i>
                     <i class="fa fa-star fa-1x star-btn" data-value="3"></i>
                     <i class="fa fa-star fa-1x star-btn" data-value="4"></i>
                     <i class="fa fa-star fa-1x star-btn" data-value="5"></i>
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <!-- Product filter end -->
      <!-- Product List -->
      <div class="col-lg-9 products">
         <div class="row">
            <?php
            foreach ($products as $p) {
               ?>
                                          <div class="col-lg-3 mb-4">
                                             <div class="card border-0">
                                                <img src="vendordashboard/<?php echo $p['image1'] ?>" alt="Product Image" class="card-img-top">
                                                <div class="card-body">
                                                   <h6 class="card-title"><a href="single_product.php?id=<?php echo $p['id'] ?>"><?php echo $p['title'] ?></a></h6>
                                                </div>
                                             </div>
                                          </div>
                                       <?php
            }
            ?>
         </div>
      </div>
   </div>
</div>
</div>
<?php
while ($rate = $ratings->fetch()) {
   ?>
                              <div class="container review-block">
                                 <p class="review-text"><?php echo substr($rate['review'], 0, 100) . '...' ?></p>
                                 <div class="review-rating">
                                    <span class="star-rating">
                                       <?php
                                       $rating = $rate['rating'];
                                       for ($i = 1; $i <= 5; $i++) {
                                          if ($i <= $rating) {
                                             echo '<i class="fa fa-star checked"></i>';
                                          } else {
                                             // echo '<i class="fa fa-star"></i>';
                                          }
                                       }
                                       ?>
                                    </span>
                                 </div>
                              </div>
                              <hr style="height: 2px;
      background-color: #ccc;
      width: 50%;
      margin: 20px auto;
      margin-left:6rem;"> <!-- add a horizontal rule divider after each review -->
                           <?php
}
?>

<?php
// Include the footer file
require_once 'footer.php';

?>
<script>
   document.querySelectorAll('.star-btn').forEach(function(star) {
      star.addEventListener('click', function() {
         document.querySelectorAll('.star-btn').forEach(function(s) {
            if (s.getAttribute('data-value') <= star.getAttribute('data-value')) {
               s.classList.remove('fa-star-o');
               s.classList.add('fa-star');
            } else {
               s.classList.remove('fa-star');
               s.classList.add('fa-star-o');
            }
         });
         document.querySelector('#rating-value').value = star.getAttribute('data-value');
      });
   });

   var minPriceInput = document.getElementById("min_price");
var maxPriceInput = document.getElementById("max_price");
var priceOutput = document.getElementById("price-output");

minPriceInput.addEventListener("input", updatePrice);
maxPriceInput.addEventListener("input", updatePrice);

function updatePrice() {
  var minPrice = minPriceInput.value;
  var maxPrice = maxPriceInput.value;

  priceOutput.textContent = "Rs " + minPrice + " - Rs " + maxPrice;
}
</script>