<?php
    while($row=mysqli_fetch_assoc($sql)){
        //Get Chat data
        $sql2="SELECT * FROM messages WHERE (incoming_msg_id={$row['id']}
                OR  outgoing_msg_id={$row['id']}) AND (outgoing_msg_id={$outgoing_id} 
                OR  incoming_msg_id ={$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
        $query2=mysqli_query($con,$sql2);
        $row2=mysqli_fetch_assoc($query2);
        if(mysqli_num_rows($query2)>0){
            $result=$row2['msg'];
        }else{
            $result="No message availabe";
        } 
        (strlen($result)>28)? $msg=substr($result,0,28) : $msg=$result;   

        ($row['status']=="Offline now")? $offline="offline":$offline="";

        $output .='<a href="chat.php?user_id='.$row['id'].'">
        <div class="content">
        <img src="../media/users/'.$row['image'].'" alt="">
            <div class="details">
                <span>'.$row['name'].'</span>
                <p>Last:'.$msg.'</p>
            </div>
        </div>
        <div class="status-dot '.$offline.'"><li class="fas fa-circle"></li></div>
    </a>';
    }

?>