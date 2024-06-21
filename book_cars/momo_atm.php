<?php
session_start();
header('Content-type: text/html; charset=utf-8');
// Kiểm tra người dùng đã đăng nhập hay chưa
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
// Lấy các tham số từ URL
if (
    isset($_GET['car_id']) &&
    isset($_GET['amount']) &&
    isset($_GET['PickUpTime']) &&
    isset($_GET['ReturnTime']) &&
    isset($_GET['payment_method']) &&
    isset($_GET['PickupLocation']) &&
    isset($_GET['DropoffLocation']) &&
    isset($_GET['PickUpDate']) &&
    isset($_GET['ReturnDate'])
) {
    $cars_id = $_GET['car_id'];
    $amount = $_GET['amount'];
    $PickUpTime = $_GET['PickUpTime'];
    $ReturnTime = $_GET['ReturnTime'];
    $payment_method = $_GET['payment_method'];
    $pickup_location = $_GET['PickupLocation'];
    $dropoff_location = $_GET['DropoffLocation'];
    $pickup_date = $_GET['PickUpDate'];
    $return_date = $_GET['ReturnDate'];

    // Lưu các dữ liệu thanh toán vào session
    $_SESSION['payment_data'] = [
        'cars_id' => $cars_id,
        'amount' => $amount,
        'ReturnTime' => $ReturnTime,
        'PickUpTime' => $PickUpTime,
        'pickup_location' => $pickup_location,
        'dropoff_location' => $dropoff_location,
        'pickup_date' => $pickup_date,
        'return_date' => $return_date,
        'payment_method' => $payment_method // Nếu có
    ];
} else {
    echo "Required parameters are missing.";
    exit();
}

// Kiểm tra xem đã lưu các dữ liệu thanh toán trong session chưa
if (!isset($_SESSION['payment_data'])) {
    echo "Required payment data not found.";
    exit();
}

// Lấy các dữ liệu thanh toán từ session
$payment_data = $_SESSION['payment_data'];
$amount = $payment_data['amount'];
$PickUpTime = $payment_data['PickUpTime'];
$ReturnTime = $payment_data['ReturnTime'];
$pickupLocation = $payment_data['pickup_location'];
$dropoffLocation = $payment_data['dropoff_location'];
$pickUpDate = $payment_data['pickup_date'];
$returnDate = $payment_data['return_date'];
$cars_id = $payment_data['cars_id']; // Lấy cars_id từ session
$paymentMethod = $payment_data['payment_method']; // Nếu có

// Các tham số cần thiết cho API MoMo
$endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
$partnerCode = 'MOMOBKUN20180529';
$accessKey = 'klm05TvNBzhg7h7j';
$secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
$orderInfo = "Thanh toán xe với cars_id: " . $cars_id;

$orderId = time() . "";
$redirectUrl = "http://localhost/Rentaly/book_cars/pay_process.php";
$ipnUrl = "http://localhost/Rentaly/book_cars/pay_process.php";
$extraData = "";

$requestId = time() . "";
$requestType = "payWithATM";

// Tạo chữ ký HMAC SHA256
$rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
$signature = hash_hmac("sha256", $rawHash, $secretKey);

// Dữ liệu gửi đi cho MoMo API
$data = [
    'partnerCode' => $partnerCode,
    'partnerName' => "Test",
    "storeId" => "MomoTestStore",
    'requestId' => $requestId,
    'amount' => $amount,
    'orderId' => $orderId,
    'orderInfo' => $orderInfo,
    'redirectUrl' => $redirectUrl,
    'ipnUrl' => $ipnUrl,
    'lang' => 'vi',
    'extraData' => $extraData,
    'requestType' => $requestType,
    'signature' => $signature,
    'cars_id' => $cars_id // Đưa cars_id vào dữ liệu gửi đi cho API
];

// Hàm thực hiện POST request
function execPostRequest($url, $data)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen(json_encode($data))
        )
    );
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    // Thực hiện request POST
    $result = curl_exec($ch);
    // Đóng kết nối
    curl_close($ch);
    return $result;
}

// Thực hiện gửi yêu cầu đến MoMo API và nhận kết quả
$result = execPostRequest($endpoint, $data);
$jsonResult = json_decode($result, true); // Giải mã JSON

// Kiểm tra kết quả và redirect đến trang thanh toán của MoMo
if (isset($jsonResult['payUrl'])) {
    $_SESSION['payment_request_id'] = $requestId; // Lưu requestId vào session
    header('Location: ' . $jsonResult['payUrl']);
} else {
    echo "Payment URL not found. Please try again.";
}
exit();
