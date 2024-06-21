<?php
session_start();
include('config/config.php'); // Kết nối tới cơ sở dữ liệu

header('Content-type: application/json');

// Lấy dữ liệu từ MoMo
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['resultCode']) && $data['resultCode'] == 0) {
    $user_id = $_SESSION['user_id'];
    $booking_id = // Lấy booking_id từ session hoặc dữ liệu POST
        $car_id = // Lấy car_id từ session hoặc dữ liệu POST
        $order_id = $data['orderId'];
    $request_id = $data['requestId'];
    $amount = $data['amount'];
    $order_info = $data['orderInfo'];
    $order_type = $data['orderType'];
    $trans_id = $data['transId'];
    $result_code = $data['resultCode'];
    $message = $data['message'];
    $response_time = $data['responseTime'];
    $extra_data = $data['extraData'];
    $payment_option = $data['paymentOption'];

    // Lưu thông tin vào bảng bookings
    $sql = "INSERT INTO bookings (user_id, car_id, start_date, end_date, status) VALUES (?, ?, ?, ?, 'scheduled')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiss", $user_id, $car_id, $start_date, $end_date); // Cần thay đổi giá trị start_date và end_date
    $stmt->execute();
    $booking_id = $stmt->insert_id;

    // Lưu thông tin vào bảng momo_payments
    $sql = "INSERT INTO momo_payments (user_id, booking_id, car_id, order_id, request_id, amount, order_info, order_type, trans_id, result_code, message, response_time, extra_data, payment_option) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiiissisisssss", $user_id, $booking_id, $car_id, $order_id, $request_id, $amount, $order_info, $order_type, $trans_id, $result_code, $message, $response_time, $extra_data, $payment_option);
    $stmt->execute();

    // Lưu thông tin vào bảng cars (ví dụ cập nhật số lượng likes)
    $sql = "UPDATE cars SET likes_count = likes_count + 1 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $car_id);
    $stmt->execute();

    echo json_encode(array("status" => "success"));
} else {
    echo json_encode(array("status" => "failed", "message" => $data['message']));
}
