<?php
    require('connection.inc.php');
    //Search function for chat users
    $outgoing_id = $_SESSION['USER_ID'];
    $searchTerm=mysqli_real_escape_string($con,$_POST['searchTerm']);
    $output="";
    $sql=mysqli_query($con,"SELECT * FROM users WHERE name LIKE '%{$searchTerm}%'");

    if (mysqli_num_rows($sql)>0) {
       include "data.php";
    }else{
        $output.="No user found";
    }
    echo $output;
?>