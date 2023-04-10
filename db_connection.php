<?php

    // Connect to the database
       $host = 'localhost'; 
       $user = 'root'; 
       $pwd = ''; 
       $dbname = 'bathik'; 
       $conn = new mysqli($host, $user, $pwd, $dbname);
       if ($conn->connect_error) {
           die('Connection failed: ' . $conn->connect_error);
       }
   
?>