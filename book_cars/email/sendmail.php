<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Đường dẫn đến autoload.php của PHPMailer

// Khởi tạo đối tượng PHPMailer
$mail = new PHPMailer(true);

try {
    // Cài đặt thông số SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.example.com'; // Địa chỉ SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'bahatmittt@gmail.com'; // Địa chỉ email và password để đăng nhập vào SMTP server
    $mail->Password = 'mkxq pnfj wrvk zaet';
    $mail->SMTPSecure = 'tls'; // Sử dụng giao thức bảo mật TLS
    $mail->Port = 587; // Cổng kết nối SMTP

    // Cài đặt thông tin người gửi và người nhận
    $mail->setFrom('bahatmittt@gmail.com', 'Nguyễn Như Vũ');
    $mail->addAddress('nhuvuthpt@gmail.com', 'vusena');

    // Định dạng email
    $mail->isHTML(true);

    // Chủ đề và nội dung email
    $mail->Subject = 'Mã OTP của bạn';
    $otp = generateOTP(); // Hàm generateOTP() để tạo mã OTP
    $mail->Body    = 'Mã OTP của bạn là: ' . $otp;

    // Gửi email
    $mail->send();
    echo 'Email đã được gửi đi!';
} catch (Exception $e) {
    echo "Gửi email thất bại: {$mail->ErrorInfo}";
}

// Hàm để tạo mã OTP ngẫu nhiên
function generateOTP()
{
    // Tạo một chuỗi ngẫu nhiên có độ dài 6 ký tự
    return substr(str_shuffle('0123456789'), 0, 6);
}
