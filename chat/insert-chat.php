<?php

    include_once "connection.inc.php";
    //Chat message send
        $outgoing_id=$_SESSION['USER_ID'];
        $incoming_id=mysqli_real_escape_string($con,$_POST['incoming_id']);
        $message=mysqli_real_escape_string($con,$_POST['message']);

        if (!empty($message)) {
            $sql=mysqli_query($con,"INSERT INTO messages(incoming_msg_id,outgoing_msg_id,msg) 
            VALUES({$incoming_id},{$outgoing_id},'{$message}')") or die();
        }
    else{

    }
?>