<?php
session_start();
header('Content-type: text/html; charset=utf-8');

// Include database connection
require 'config/config.php';

// Function to save booking data into the database
function saveBooking($conn, $data)
{
    $sql = "INSERT INTO bookings (
                user_id, car_id, vehicle_type, pick_up_location, destination,
                pick_up_date, pick_up_time, return_date, return_time,
                name, email, phone, message, status, created_at, updated_at
            ) VALUES (
                ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW()
            )";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        'iissssssssssss',
        $data['user_id'],
        $data['car_id'],
        $data['vehicle_type'],
        $data['pickup_location'],
        $data['destination'],
        $data['pickup_date'],
        $data['pickup_time'],
        $data['return_date'],
        $data['return_time'],
        $data['name'],
        $data['email'],
        $data['phone'],
        $data['message'],
        $data['status']
    );

    if ($stmt->execute()) {
        return $conn->insert_id; // Return the booking ID
    } else {
        return false;
    }
}

// Function to save payment data into the database
function savePayment($conn, $data)
{
    $sql = "INSERT INTO momo_payments (
                user_id, booking_id, car_id, partner_code, order_id, request_id, amount, order_info,
                order_type, trans_id, result_code, message, response_time, extra_data,
                pay_type, signature, payment_option, payment_status, created_at, updated_at
            ) VALUES (
                ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW()
            )";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        'iiisiissiiisssssss',
        $data['user_id'],
        $data['booking_id'],
        $data['car_id'],
        $data['partner_code'],
        $data['order_id'],
        $data['request_id'],
        $data['amount'],
        $data['order_info'],
        $data['order_type'],
        $data['trans_id'],
        $data['result_code'],
        $data['message'],
        $data['response_time'],
        $data['extra_data'],
        $data['pay_type'],
        $data['signature'],
        $data['payment_option'],
        $data['payment_status']
    );

    return $stmt->execute();
}

// Get MoMo payment result from URL
$payment_data_available = isset($_SESSION['payment_data']) && isset($_SESSION['payment_request_id']);
$payment_result_success = isset($_GET['resultCode']) && $_GET['resultCode'] == 0;

if ($payment_data_available) {
    $payment_data = $_SESSION['payment_data'];
    $user_id = $_SESSION['user_id'];

    // Determine booking status based on payment result
    $booking_status = $payment_result_success ? 'scheduled' : 'cancelled';

    // Prepare booking data
    $booking_data = [
        'user_id' => $user_id,
        'car_id' => $payment_data['car_id'],
        'vehicle_type' => 'car', // Assuming vehicle type is 'car'. Adjust if needed.
        'pickup_location' => $payment_data['pickup_location'],
        'destination' => $payment_data['destination'],
        'pickup_date' => date('Y-m-d', strtotime($payment_data['pickup_date'])),
        'pickup_time' => $payment_data['pickup_time'],
        'return_date' => date('Y-m-d', strtotime($payment_data['return_date'])),
        'return_time' => $payment_data['return_time'],
        'name' => $payment_data['name'],
        'email' => $payment_data['email'],
        'phone' => $payment_data['phone'],
        'message' => $payment_data['message'],
        'status' => $booking_status
    ];

    // Save booking data
    $booking_id = saveBooking($conn, $booking_data);

    if ($booking_id) {
        // Prepare payment data
        $payment_status = $payment_result_success ? 'completed' : 'failed'; // Check resultCode for payment status

        $payment_save_data = [
            'user_id' => $user_id,
            'booking_id' => $booking_id,
            'car_id' => $payment_data['car_id'],
            'partner_code' => $_GET['partnerCode'],
            'order_id' => $_GET['orderId'],
            'request_id' => $_GET['requestId'],
            'amount' => $_GET['amount'],
            'order_info' => $_GET['orderInfo'],
            'order_type' => $_GET['orderType'],
            'trans_id' => $_GET['transId'],
            'result_code' => $_GET['resultCode'],
            'message' => $_GET['message'],
            'response_time' => $_GET['responseTime'],
            'extra_data' => $_GET['extraData'],
            'pay_type' => $_GET['payType'],
            'signature' => $_GET['signature'],
            'payment_option' => $payment_data['payment_method'],
            'payment_status' => $payment_status,
        ];

        // Save payment data
        if (savePayment($conn, $payment_save_data)) {
            if ($payment_result_success) {
                header('location: account-dashboard.php');
            } else {
                header('location: account-dashboard.php');
            }
        } else {
            echo "Failed to save payment.";
        }
    } else {
        echo "Failed to save booking.";
    }

    // Clear session payment data
    unset($_SESSION['payment_data']);
    unset($_SESSION['payment_request_id']);
} else {
    echo "Payment data not found in session.";
}

$conn->close();
