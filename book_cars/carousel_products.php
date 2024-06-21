<?php
include('config/config.php');

// SQL query to fetch car details
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

$result = mysqli_query($conn, $sql);

function formatPrice($price)
{
    // Check if the price has a decimal part and remove it if it's ".00"
    return (strpos($price, '.00') !== false) ? rtrim(rtrim($price, '0'), '.') : $price;
}

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
?>
        <div class="col-lg-12">
            <div class="de-item mb30">
                <div class="d-img">
                    <img src="<?php echo $row['front_image'] ?>" class="img-fluid" alt="" />
                </div>
                <div class="d-info">
                    <div class="d-text">
                        <h4><?php echo $row['name'] ?></h4>
                        <div class="d-item_like">
                            <i class="fa fa-heart"></i><span><?php echo $row['likes_count'] ?></span>
                        </div>
                        <div class="d-atr-group">
                            <span class="d-atr"><img src="images/icons/1-green.svg" alt="" /><?php echo $row['seat'] ?></span>
                            <span class="d-atr"><img src="images/icons/2-green.svg" alt="" /><?php echo $row['luggage'] ?></span>
                            <span class="d-atr"><img src="images/icons/3-green.svg" alt="" /><?php echo $row['door'] ?></span>
                            <span class="d-atr"><img src="images/icons/4-green.svg" alt="" /><?php echo $row['body'] ?></span>
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