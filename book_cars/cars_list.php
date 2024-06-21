<?php
include('config/config.php');

// Initialize variables for filters
$filters = [];

// Vehicle Type Filter
if (!empty($_GET['vehicle_type'])) {
    $vehicle_types = implode("','", $_GET['vehicle_type']);
    $filters[] = "c.body IN ('$vehicle_types')";
}

// Car Body Type Filter
if (!empty($_GET['car_body_type'])) {
    $car_body_types = implode("','", $_GET['car_body_type']);
    $filters[] = "c.body IN ('$car_body_types')";
}

// Car Seats Filter
if (!empty($_GET['car_seat'])) {
    $car_seat_filters = [];
    foreach ($_GET['car_seat'] as $seat) {
        if ($seat == '7+') {
            $car_seat_filters[] = "c.seat > 6";
        } else {
            $car_seat_filters[] = "c.seat = $seat";
        }
    }
    $filters[] = "(" . implode(" OR ", $car_seat_filters) . ")";
}

// Car Engine Capacity Filter
if (!empty($_GET['car_engine'])) {
    $car_engine_filters = [];
    foreach ($_GET['car_engine'] as $engine) {
        switch ($engine) {
            case '1000 - 2000':
                $car_engine_filters[] = "cd.engine_capacity BETWEEN 1000 AND 2000";
                break;
            case '2000 - 4000':
                $car_engine_filters[] = "cd.engine_capacity BETWEEN 2000 AND 4000";
                break;
            case '4000 - 6000':
                $car_engine_filters[] = "cd.engine_capacity BETWEEN 4000 AND 6000";
                break;
            case '6000+':
                $car_engine_filters[] = "cd.engine_capacity > 6000";
                break;
        }
    }
    $filters[] = "(" . implode(" OR ", $car_engine_filters) . ")";
}

// Price Filter
$price_min = isset($_GET['price_min']) ? intval($_GET['price_min']) : 0;
$price_max = isset($_GET['price_max']) ? intval($_GET['price_max']) : 2000;
$filters[] = "cd.total_price BETWEEN $price_min AND $price_max";

// Base SQL query
$sql = "SELECT 
                                    c.id,
                                    c.name,
                                    c.body,
                                    c.seat,
                                    c.door,
                                    c.luggage,
                                    cd.total_price,
                                    ci.front_image,
                                    c.likes_count
                                FROM 
                                    cars c
                                JOIN 
                                    cars_details cd ON c.id = cd.car_id
                                JOIN 
                                    cars_image ci ON c.id = ci.car_id";

// Append filters to SQL query
if (!empty($filters)) {
    $sql .= " WHERE " . implode(" AND ", $filters);
}

$result = mysqli_query($conn, $sql);

function formatPrice($price)
{
    // Check if the price has a decimal part and remove it if it's ".00"
    return (strpos($price, '.00') !== false) ? rtrim(rtrim($price, '0'), '.') : $price;
}

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
?>
        <div class="col-xl-4 col-lg-6">
            <div class="de-item mb30">
                <div class="d-img">
                    <img src="<?php echo $row['front_image'] ?>" class="img-fluid" alt="">
                </div>
                <div class="d-info">
                    <div class="d-text">
                        <h4><?php echo $row['name'] ?></h4>
                        <div class="d-item_like">
                            <i class="fa fa-heart favorite-btn" data-car-id="<?php echo $row['id']; ?>"></i><span><?php echo $row['likes_count'] ?></span>
                        </div>
                        <div class="d-atr-group">
                            <span class="d-atr"><img src="images/icons/1-green.svg" alt=""><?php echo $row['seat'] ?></span>
                            <span class="d-atr"><img src="images/icons/2-green.svg" alt=""><?php echo $row['luggage'] ?></span>
                            <span class="d-atr"><img src="images/icons/3-green.svg" alt=""><?php echo $row['door'] ?></span>
                            <span class="d-atr"><img src="images/icons/4-green.svg" alt=""><?php echo $row['body'] ?></span>
                        </div>
                        <div class="d-price">
                            Daily rate from <span>$<?php echo formatPrice($row['total_price']) ?></span>
                            <a class="btn-main" href="car-single.php?cars_id=<?php echo $row['id'] ?>">Rent Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
} else {
    echo "No cars found";
}

mysqli_close($conn);
?>