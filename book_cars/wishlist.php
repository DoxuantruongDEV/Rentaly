<?php
include('config/config.php'); // kết nối cơ sở dữ liệu
// Assuming the session contains user_id
$user_id = $_SESSION['user_id'];

$sql = "SELECT
    users.id AS user_id,
    users.username AS user_name,
    cars.name AS car_name,
    cars_image.front_image,
    cars.seat,
    cars.luggage,
    cars.door,
    cars_details.fuel_type,
    cars.horsepower,
    cars_details.engine,
    cars_details.drive,
    cars.body,
    cars_details.total_price
FROM
    wishlist
JOIN
    users ON wishlist.user_id = users.id
JOIN
    cars ON wishlist.car_id = cars.id
JOIN
    cars_image ON cars.id = cars_image.car_id
JOIN
    cars_details ON cars.id = cars_details.car_id
WHERE
    users.id = ?
ORDER BY
    users.id;";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) : ?>
        <div class="de-item-list no-border mb30">
            <div class="d-img">
                <img src="<?php echo $row['front_image']; ?>" class="img-fluid" alt="">
            </div>
            <div class="d-info">
                <div class="d-text">
                    <h4><?php echo $row['car_name']; ?></h4>
                    <div class="d-atr-group">
                        <ul class="d-atr">
                            <li><span>Seats:</span> <?php echo $row['seat']; ?></li>
                            <li><span>Luggage:</span> <?php echo $row['luggage']; ?></li>
                            <li><span>Doors:</span> <?php echo $row['door']; ?></li>
                            <li><span>Fuel:</span> <?php echo $row['fuel_type']; ?></li>
                            <li><span>Horsepower:</span> <?php echo $row['horsepower']; ?></li>
                            <li><span>Engine:</span> <?php echo $row['engine']; ?></li>
                            <li><span>Drive:</span> <?php echo $row['drive']; ?></li>
                            <li><span>Type:</span> <?php echo $row['body']; ?></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="d-price">
                Daily rate from <span>$<?php echo $row['total_price']; ?></span>
                <a class="btn-main" href="car-single.php">Rent Now</a>
            </div>
            <div class="clearfix"></div>
        </div>
<?php endwhile;
} else {
    echo '<div class="alert alert-warning" role="alert">';
    echo '  Bạn chưa thêm xe nào vào danh sách yêu thích';
    echo '</div>';
}

?>