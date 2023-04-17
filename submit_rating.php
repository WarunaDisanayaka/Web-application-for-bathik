<?php
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $shop = $_POST['shop'];
    $review = $_POST['review'];
    $rating = $_POST['rating'];

    // Validate the form data
    // ...

    // Save the form data to the database
    // ...

    // Redirect to a thank-you page
    header('Location: thank_you.php');
    exit;
}
?>
