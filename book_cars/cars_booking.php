<?php
session_start();

// Assuming you have a function to check login status and payment status
function isUserLoggedIn()
{
    // Implement your login check logic here
    return isset($_SESSION['user_id']);
}

function hasUserPaid()
{
    // Implement your payment check logic here
    // Example: check the user's payment status in the database
    $userId = $_SESSION['user_id'];
    // Assuming you have a database connection $conn
    $sql = "";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['payment_status'] === 'paid';
}

if (!isUserLoggedIn()) {
    header("Location: login.php");
    exit();
}

if (!hasUserPaid()) {
    header("Location: momo_atm.php");
    exit();
}

// Process booking details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect booking details from the form
    $vehicleType = $_POST['vehicle_type'];
    $pickUpLocation = $_POST['Pick Up Location'];
    $destination = $_POST['Destination'];
    $pickUpDate = $_POST['Pick Up Date'];
    $pickUpTime = $_POST['Pick Up Time'];
    $returnDate = $_POST['Return Date'];
    $returnTime = $_POST['Return Time'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    // Insert booking details into the database
    $sql = "INSERT INTO bookings (user_id, vehicle_type, pick_up_location, destination, pick_up_date, pick_up_time, return_date, return_time, name, email, phone, message)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssssssssss", $_SESSION['user_id'], $vehicleType, $pickUpLocation, $destination, $pickUpDate, $pickUpTime, $returnDate, $returnTime, $name, $email, $phone, $message);
    if ($stmt->execute()) {
        // Redirect to a confirmation page or display a success message
        echo "Booking successful!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
