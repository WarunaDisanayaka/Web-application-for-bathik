<?php
include_once "header.php";
?>
    <div class="wrapper">
        <section class="chat-area">
            <header>
            <?php
                    include_once "connection.inc.php";
                    $user_id=mysqli_real_escape_string($con,$_GET['user_id']);
                    $sql=mysqli_query($con,"SELECT * FROM users WHERE id={$user_id}");
                    if (mysqli_num_rows($sql)>0) {
                        $row=mysqli_fetch_assoc($sql);
                    }
                ?>
                <a href="" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="../media/users/<?php echo $row['image']; ?>" alt="">
                    <div class="details">
                        <span><?php echo $row['name'];?></span>
                        <p><?php echo $row['status'];?></p>
                    </div>
            </header>
            <div class="chat-box">
                
            </div>
            <form action="#" class="typing-area">
                <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id;?>" hidden>
                <input type="text" name="message" class="input-field" placeholder="Type a message here....." autocomplete="off">
                <button><i class="fab fa-telegram-plane"></i></button>
            </form>
            
        </section>
    </div>

    <script src="js/chat.js"></script>
</body>
</html>