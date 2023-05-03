<?php
session_start();

require_once 'header.php';

// Connect to the database
$host = 'localhost';
$user = 'root';
$pwd = '';
$dbname = 'bathik';
$conn = new mysqli($host, $user, $pwd, $dbname);

//  Checking product id 
if (isset($_POST['message'])) {
    $shop = $_POST['shop'];
    $userid = $_POST['userid'];
    $message = $_POST['message'];
    $username = $_POST['username'];

    $insert = "INSERT INTO messages(shop_id,user_id,username,message,incoming_id) VALUES('$shop','$userid','$username','$message','0')";
    $r = $conn->query($insert);

    echo "<script>
    swal({
       title: 'Message send successfully',
       text: 'Thank you for your message!',
       icon: 'success',
       button: 'OK',
    }).then(function() {
       window.location.href = 'shop.php?id=" . $_SESSION["shop"] . "';
    });
    </script>";

}


?>
