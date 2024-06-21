<?php
include 'config/config.php';

// SQL query to fetch data
$sql = "SELECT 
            mp.order_id,
            c.name AS car_name,
            cd.total_price,
            ci.front_image,
            cbc.your_name,
            cbc.your_phone,
            cbc.your_description,
            b.pick_up_location,
            b.destination,
            b.start_date,
            b.end_date,
            b.status,
            b.created_at
        FROM 
            momo_payments mp
        JOIN 
            bookings b ON mp.booking_id = b.booking_id
        JOIN 
            customer_booking_car cbc ON mp.booking_id = cbc.booking_id
        JOIN 
            cars c ON mp.car_id = c.id
        JOIN 
            cars_details cd ON mp.car_id = cd.car_id
        JOIN 
            cars_image ci ON mp.car_id = ci.car_id";

$result = $conn->query($sql);

function formatPrice($price)
{
    return (strpos($price, '.00') !== false) ? rtrim(rtrim($price, '0'), '.') : $price;
}
?>

<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>Rentaly - Multipurpose Vehicle Car Rental Website Template</title>
    <link rel="icon" href="images/icon.png" type="image/gif" sizes="16x16">
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Rentaly - Multipurpose Vehicle Car Rental Website Template" name="description">
    <meta content="" name="keywords">
    <meta content="" name="author">
    <!-- CSS Files ================================================== -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap">
    <link href="css/mdb.min.css" rel="stylesheet" type="text/css" id="mdb">
    <link href="css/plugins.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/coloring.css" rel="stylesheet" type="text/css">
    <!-- color scheme -->
    <link id="colors" href="css/colors/scheme-01.css" rel="stylesheet" type="text/css">
</head>
<body class="container my-5">

<h2>Customer Bookings</h2>

<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Xe khách hàng đặt</th>
                <th>Name</th>
                <th>Sdt</th>
                <th>Mô tả</th>
                <th>Địa điểm đón</th>
                <th>Địa điểm kết thúc</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Trạng thái</th>
                <th>Giờ đặt</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td class='d-flex align-items-center' style='padding-right: 50px'>
                            <img src='" . $row['front_image'] . "' alt='Image' class='img-thumbnail' style='width: 60px; height: 60px;'>
                            <div class='ml-3'>
                                <b>" . $row['car_name'] . "</b>
                                <p class='mb-0'>" . $row['order_id'] . " | $" . formatPrice($row['total_price']) . "</p>
                            </div>
                          </td>";
                    echo "<td>" . $row['your_name'] . "</td>";
                    echo "<td>" . $row['your_phone'] . "</td>";
                    echo "<td>" . $row['your_description'] . "</td>";
                    echo "<td>" . $row['pick_up_location'] . "</td>";
                    echo "<td>" . $row['destination'] . "</td>";
                    echo "<td>" . $row['start_date'] . "</td>";
                    echo "<td>" . $row['end_date'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";
                    echo "<td>" . $row['created_at'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='11'>No bookings found</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<script src="js/plugins.js"></script>
<script src="js/designesia.js"></script>
<!-- <script src='../../../www.google.com/recaptcha/api.js' async defer></script> -->
<script src="booking-form.js"></script>

</body>
</html>
