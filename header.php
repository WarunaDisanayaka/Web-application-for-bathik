<?php
session_start();
if (isset($_SESSION['email'])) {
   $user = $_SESSION['email'];
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
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCr3P8F9580lfZt5dQA_7N64X3XNaejsRA"></script>


      <!-- Sweet alert CDN -->
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="js/index.js"></script>
      <link rel="stylesheet" href="css/main.css">
      <title>Welcome to bathik</title>
      <style>
         .navbar-nav .nav-item.active > .nav-link {
    color: black; /* Change the color to whatever you like */
    font-weight: bold; /* Optionally add bold font weight */
}

      </style>
   </head>
   <body>
      <!-- Header started -->
      <header class="navbar navbar-expand-lg navbar-light bg-light">
         <div class="container">
            <a class="navbar-brand" href="index.php"><img src="./img/logo.png" style="max-height: 16rem; max-width:40rem; position:absolute; z-index:10; margin-top:-8rem;"></a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
               <ul class="navbar-nav ms-auto">
                  <li class="nav-item">
                     <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="aboutus.php">About Us</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="allshop.php">Shops</a>
                  </li>
                  <li class="nav-item">
                  <a class="nav-link" href="http://127.0.0.1:8000/" onclick="return checkLogin();" target="_blank">Personalization</a>
                  <input type="hidden" name="user" id="user" value="<?php echo $user; ?>">
                  </li>
                  <li class="nav-item">
                  <a class="nav-link" href="favourites.php">Favorites</a>

                  </li>
                  <li class="nav-item">
                     <a href="cart.php" class="nav-link">
                     <i class="fas fa-shopping-cart"></i>
                     <span id="cart-item" class="badge bg-danger"></span>
                     </a>
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

      <script>
         load_cart();

         function load_cart(){
            $.ajax({
               url:'add_to_cart.php',
               method: 'get',
               data:{cartItem:"cart_item"},
               success:function(response){
                  $('#cart-item').html(response);
               }
            });
         }

         
    function checkLogin() {
        var userId = document.getElementById('user').value;
        if (!<?php echo isset($_SESSION['userid']) ? 'true' : 'false'; ?>) {
         swal({
              title: 'Warning!',
              text: 'Please login to you account!',
              icon: 'warning',
              button: 'OK'
          });
            return false;
        }
       
      }

      // get the current page URL
var current_url = window.location.href;

// select all navigation links
var nav_links = document.querySelectorAll('.navbar-nav .nav-link');

// iterate over the navigation links
for (var i = 0; i < nav_links.length; i++) {
    var nav_link = nav_links[i];
    var nav_link_url = nav_link.getAttribute('href');
    // check if the current URL matches the link URL
    if (nav_link_url && current_url.indexOf(nav_link_url) !== -1) {
        // if yes, add the "active" class to the <li> element
        nav_link.parentNode.classList.add('active');
    }
}


      </script>