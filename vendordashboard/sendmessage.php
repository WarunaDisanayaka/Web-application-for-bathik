<?php
session_start();

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

    $insert = "INSERT INTO messages(shop_id,user_id,username,message,incoming_id) VALUES('$shop','$userid','$username','$message','1')";
    $r = $conn->query($insert);

    header("Location: " . $_SERVER['HTTP_REFERER']);

}


?>
