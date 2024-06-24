<?php
include 'config/config.php';
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid id provided");
}
$id = $_GET['id'];  // Get the car ID from the URL

// SQL query to delete user favorites related to the car
$sql0 = "DELETE FROM user_favorites WHERE car_id = $id";
$query0 = mysqli_query($conn, $sql0);

// SQL query to delete the car details
$sql1 = "DELETE FROM cars_details WHERE car_id = $id";
$query1 = mysqli_query($conn, $sql1);

// SQL query to delete the car images
$sql2 = "DELETE FROM cars_image WHERE car_id = $id";
$query2 = mysqli_query($conn, $sql2);

// SQL query to delete the car
$sql3 = "DELETE FROM cars WHERE id = $id";
$query3 = mysqli_query($conn, $sql3);

if ($query0 && $query1 && $query2 && $query3) {
    header('Location: admin.php');  // Redirect to the admin page
} else {
    echo "Error deleting record: " . mysqli_error($conn);  // Display an error message
}
