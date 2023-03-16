<?php
// Active the store
if (isset($_GET['id'])) {
    $store_id = $_GET['store_id'];
    echo $store_id;
    // $sql = "UPDATE stores SET active = 1 WHERE store_id = ?";
    // $stmt = $pdo->prepare($sql);
    // $stmt->execute([$store_id]);

    // Redirect back to the same page
    // header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

?>