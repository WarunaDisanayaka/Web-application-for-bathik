<?php 

require('connection.inc.php');
//Select users function
$outgoing_id=$_SESSION['USER_ID'];
$sql=mysqli_query($con,"SELECT * FROM users WHERE NOT id={$outgoing_id}");
$output="";

if (mysqli_num_rows($sql)==1) {
    $output .="No users are available to chat";
}elseif(mysqli_num_rows($sql)>0){
    include "data.php";
}

echo $output;

?>