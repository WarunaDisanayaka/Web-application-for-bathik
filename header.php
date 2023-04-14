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
      

      <!-- Sweet alert CDN -->
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <link rel="stylesheet" href="css/main.css">
      <title>Welcome to bathik</title>
   </head>
   <body>
      <!-- Header started -->
      <header class="navbar navbar-expand-lg navbar-light bg-light">
         <div class="container">
            <a class="navbar-brand" href="index.php">Logo</a>
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
                  <a class="nav-link" href="http://127.0.0.1:8000/" target="_blank">Personalization</a>

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
      </script>