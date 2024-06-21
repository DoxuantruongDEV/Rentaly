<?php
session_start();
header('Content-type: text/html; charset=utf-8');
include('config/config.php');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Define the conversion rate from USD to VND
define('USD_TO_VND', 23000);

// Retrieve form data
$car_id = $_POST['car_id'];
$pickup_location = $_POST['pickup_location'];
$destination = $_POST['destination'];
$pickup_date = $_POST['pickup_date'];
$pickup_time = $_POST['pickup_time'];
$return_date = $_POST['return_date'];
$return_time = $_POST['return_time'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];

// Retrieve the price of the selected vehicle from the database
$sql = "SELECT total_price FROM cars_details WHERE car_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $car_id); // Assuming car_id is an integer
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$price_usd = $row['total_price'];
$stmt->close();

// Convert the price to VND
$amount_vnd = $price_usd * USD_TO_VND;

// Prepare payment data to save in session
$payment_data = [
    'car_id' => $car_id,
    'pickup_location' => $pickup_location,
    'destination' => $destination,
    'pickup_date' => $pickup_date,
    'pickup_time' => $pickup_time,
    'return_date' => $return_date,
    'return_time' => $return_time,
    'name' => $name,
    'email' => $email,
    'phone' => $phone,
    'message' => $message,
    'payment_method' => 'momo' // Assuming MoMo as payment method
];

// Save payment data to session
$_SESSION['payment_data'] = $payment_data;

// MoMo payment API endpoint and credentials
$endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
$partnerCode = 'MOMOBKUN20180529';
$accessKey = 'klm05TvNBzhg7h7j';
$secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
$orderInfo = "Thanh toán qua MoMo";
$orderId = time() . "";
$redirectUrl = "http://localhost/Rentaly/book_cars/pay_success.php";
$ipnUrl = "http://localhost/Rentaly/book_cars/pay_success.php";
$extraData = "";

$requestId = time() . "";
$requestType = "payWithATM";

// Create HMAC SHA256 signature
$rawHash = "accessKey=" . $accessKey . "&amount=" . $amount_vnd . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
$signature = hash_hmac("sha256", $rawHash, $secretKey);

$data = array(
    'partnerCode' => $partnerCode,
    'partnerName' => "Test",
    "storeId" => "MomoTestStore",
    'requestId' => $requestId,
    'amount' => $amount_vnd,
    'orderId' => $orderId,
    'orderInfo' => $orderInfo,
    'redirectUrl' => $redirectUrl,
    'ipnUrl' => $ipnUrl,
    'lang' => 'vi',
    'extraData' => $extraData,
    'requestType' => $requestType,
    'signature' => $signature
);

// Function to send POST request
function execPostRequest($url, $data)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen(json_encode($data))
    ));
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

$result = execPostRequest($endpoint, $data);
$jsonResult = json_decode($result, true);

// Redirect user to MoMo payment page
header('Location: ' . $jsonResult['payUrl']);
exit();
