<?php
    include_once "connection.inc.php";
    //Get chat data to inbox
    $outgoing_id = $_SESSION['USER_ID'];
        $incoming_id=mysqli_real_escape_string($con,$_POST['incoming_id']);
        $output="";

        $sql="SELECT * FROM messages 
        LEFT JOIN users ON users.id=messages.incoming_msg_id
        WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
        OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
        $query=mysqli_query($con,$sql);
        if(mysqli_num_rows($query)>0){
            while($row=mysqli_fetch_assoc($query)){
                if ($row['outgoing_msg_id']===$outgoing_id) {
                    $output.='<div class="chat outgoing">
                    <div class="details">
                        <p>'.$row['msg'].'</p>
                    </div>
                </div>';
                }else{
                    $output.='<div class="chat incoming">
                    <img src="../media/users/'.$row['image'].'" alt="">
                    <p></p>
                    <div class="details">
                        <p>'.$row['msg'].'</p>
                    </div>
                </div>';
                }
            }
            
        }
        echo $output;
?>