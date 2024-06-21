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

// Retrieve form data and validate
$car_id = isset($_POST['car_id']) ? $_POST['car_id'] : null;
$pickup_location = isset($_POST['pickup_location']) ? $_POST['pickup_location'] : null;
$destination = isset($_POST['destination']) ? $_POST['destination'] : null;
$pickup_date = isset($_POST['pickup_date']) ? $_POST['pickup_date'] : null;
$pickup_time = isset($_POST['pickup_time']) ? $_POST['pickup_time'] : null;
$return_date = isset($_POST['return_date']) ? $_POST['return_date'] : null;
$return_time = isset($_POST['return_time']) ? $_POST['return_time'] : null;
$name = isset($_POST['name']) ? $_POST['name'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$phone = isset($_POST['phone']) ? $_POST['phone'] : null;
$message = isset($_POST['message']) ? $_POST['message'] : null;

if (!$car_id || !$pickup_location || !$destination || !$pickup_date || !$pickup_time || !$return_date || !$return_time || !$name || !$email || !$phone) {
    die('Some required fields are missing.');
}

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
$redirectUrl = "http://localhost/Rentaly/book_cars/pay_momo.php";
$ipnUrl = "http://localhost/Rentaly/book_cars/pay_momo.php";
$extraData = "";

$requestId = time() . "";
$requestType = "payWithATM";

// Create HMAC SHA256 signature
$rawHash = "accessKey=" . $accessKey . "&amount=" . $amount_vnd . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
$signature = hash_hmac("sha256", $rawHash, $secretKey);

$data = array(
    'partnerCode' => $partnerCode,
    'partnerName' => "Test",
    'storeId' => "MomoTestStore",
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

$result = sendRequestToMoMo($endpoint, json_encode($data));
$jsonResult = json_decode($result, true);

// Kiểm tra kết quả và redirect đến trang thanh toán của MoMo
if (isset($jsonResult['payUrl'])) {
    $_SESSION['payment_request_id'] = $requestId; // Lưu requestId vào session
    header('Location: ' . $jsonResult['payUrl']);
} else {
    echo "Payment URL not found. Please try again.";
}
exit();

function sendRequestToMoMo($endpoint, $jsonData)
{
    $ch = curl_init($endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
