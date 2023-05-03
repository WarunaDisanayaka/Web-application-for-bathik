<?php
session_start();
//Database connection
$con=mysqli_connect("localhost","root","","ar");
define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/php/AR/');
define('SITE_PATH','http://localhost/AR/');

//Define product images
define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'media/product/');
define('PRODUCT_IMAGE_SITE_PATH',SITE_PATH.'media/product/');
?>