<?php
include_once "header.php";
?>
<body>
    <div class="wrapper">
        <section class="users">
            <header>
                <?php
                //Showing availabe users to chat
                    include_once "connection.inc.php";
                    $sql=mysqli_query($con,"SELECT * FROM users WHERE id={$_SESSION['USER_ID']}");
                    if (mysqli_num_rows($sql)>0) {
                        $row=mysqli_fetch_assoc($sql);
                    }
                ?>
                <div class="content">
                <img src="../media/users/<?php echo $row['image']; ?>" alt="">
                    <div class="details">
                        <span><?php echo $row['name'];?></span>
                        <p><?php echo $row['status'];?></p>
                    </div>
                </div>
            </header>
            <div class="search">
                <span class="text">Select an user to start chat</span>
                <input type="text" placeholder="Enter name to search...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="users-list">
           
            </div>
        </section>
    </div>

    <script src="js/users.js"></script>
</body>
</html>