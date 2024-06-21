<?php
session_start();
// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
// Include the database configuration file
include('config/config.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $user_id = $_SESSION['user_id'];
    $your_name = $_POST['name'];
    $your_email = $_POST['email'];
    $your_phone = $_POST['phone'];
    $your_description = $_POST['message'];

    // Insert the feedback into the database
    $sql = "INSERT INTO customer_feedback (user_id, your_name, your_email, your_phone, your_description)
            VALUES ('$user_id', '$your_name', '$your_email', '$your_phone', '$your_description')";

    if (mysqli_query($conn, $sql)) {
        header('Location: contact.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
