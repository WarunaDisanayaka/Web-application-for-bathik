<?php

// Get stores data
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bathik";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_GET['id'])) {
    $store_id = $_GET['id'];
    $sql = "UPDATE stores SET active=0 WHERE store_id = ?";
    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $store_id);

    // Execute the SQL statement
    if ($stmt->execute()) {

        echo "<script>
        alert('Store deactivated successfully!');
        window.location.href = document.referrer;
    </script>";



    } else {
        echo "Error updating record: " . $conn->error;
    }
}

?>