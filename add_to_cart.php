<?php
   session_start();

   if (!isset($_SESSION['email'])) {
      // Redirect to the login page
     
      // echo("Please login");
      exit();
  
  }
  

   // Connect to the database
   $host = 'localhost'; 
   $user = 'root'; 
   $pwd = ''; 
   $dbname = 'bathik'; 
   $conn = new mysqli($host, $user, $pwd, $dbname);
   
   //  Checking product id 
   if (isset($_POST['pid'])) {
      $pid = $_POST['pid'];
      $pname = $_POST['pname'];
      $pprice = $_POST['pprice'];
      $size = $_POST['size'];
      $shop = $_SESSION['shop'];
      $user_id = $_SESSION['userid'];
      $qty = 1;
   
      $sql = "SELECT id FROM cart WHERE id='$pid'";
      $result = $conn->query($sql);
   
      if ($result->num_rows == 0) {
          $insert = "INSERT INTO cart(id,product_name,product_price,size,qty,total_price,shop,user_id) VALUES('$pid','$pname','$pprice','$size','$qty','$qty','$shop','$user_id')";
          $r = $conn->query($insert);
      }else{
          echo "<script>
          alert('Item already added!')
          </script>";
      }
   
   
   }
   
   
   //  Product count
   if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
   
      $sql = "SELECT * FROM cart";
      $result = $conn->query($sql);
      $rows = $result->num_rows;
      
      echo $rows;
   
   
   }
   
   
   //Remove cart item
   if (isset($_GET['remove'])) {
      $id = $_GET['remove'];
      $remove = "DELETE FROM cart WHERE id='$id'";
      $remove_execute=$conn->query($remove);
   
      if ($remove_execute) {
          header('location:cart.php');
      }
   }
   
   ?>