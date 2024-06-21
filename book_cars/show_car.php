<?php
include('config/config.php');

// SQL query to fetch car details

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM cars WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $car = mysqli_fetch_assoc($result);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM cars_details WHERE car_id = $id";
    $result = mysqli_query($conn, $sql);
    $car_details = mysqli_fetch_assoc($result);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM cars_image WHERE car_id = $id";
    $result = mysqli_query($conn, $sql);
    $car_images = mysqli_fetch_assoc($result);

    // $car_images = [];
    // while($row = mysqli_fetch_assoc($result)){
    //     $car_images[] = $row;
    // }

    // $car['images'] = $car_images;

    // echo "<pre>";
    // print_r($car_images);
}
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

<body>
    <div id="wrapper">
        <!-- page preloader begin -->
        <div id="de-preloader"></div>
        <!-- page preloader close -->

        <!-- header begin -->
        <div class="no-bottom no-top zebra" id="content">
            <div id="top"></div>

            <section id="section-car-details">
                <div class="container">
                    <div class="row g-5">
                        <div class="col-lg-6">
                            <div id="slider-carousel" class="owl-carousel">
                                <div class="item">
                                    <img src=<?php echo $car_images['front_image'] ?> alt="">
                                </div>
                                <div class="item">
                                    <img src=<?php echo $car_images['rear_image'] ?> alt="">
                                </div>
                                <div class="item">
                                    <img src=<?php echo $car_images['right_image'] ?> alt="">
                                </div>
                                <div class="item">
                                    <img src=<?php echo $car_images['left_image'] ?> alt="">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <h3><?php echo $car['name'] ?></h3>
                            <p><?php echo $car_details['description'] ?></p>

                            <div class="spacer-10"></div>

                            <h4>Specifications</h4>
                            <div class="de-spec">
                                <div class="d-row">
                                    <span class="d-title">Body</span>
                                    <span class="d-value"><?php echo $car['body'] ?></span>
                                </div>
                                <div class="d-row">
                                    <span class="d-title">Seat</span>
                                    <span class="d-value"><?php echo $car['seat'] ?> seats</span>
                                </div>
                                <div class="d-row">
                                    <span class="d-title">Door</span>
                                    <span class="d-value"><?php echo $car['door'] ?> doors</span>
                                </div>
                                <div class="d-row">
                                    <span class="d-title">Luggage</span>
                                    <span class="d-value"><?php echo $car['luggage'] ?></span>
                                </div>
                                <div class="d-row">
                                    <span class="d-title">Fuel Type</span>
                                    <span class="d-value"><?php echo $car_details['fuel_type'] ?></span>
                                </div>
                                <div class="d-row">
                                    <span class="d-title">Engine</span>
                                    <span class="d-value"><?php echo $car_details['engine_capacity'] ?></span>
                                </div>
                                <div class="d-row">
                                    <span class="d-title">Year</span>
                                    <span class="d-value"><?php echo $car_details['year'] ?></span>
                                </div>
                                <div class="d-row">
                                    <span class="d-title">Mileage</span>
                                    <span class="d-value"><?php echo $car_details['mileage'] ?></span>
                                </div>
                                <div class="d-row">
                                    <span class="d-title">Transmission</span>
                                    <span class="d-value"><?php echo $car_details['transmission'] ?></span>
                                </div>
                                <div class="d-row">
                                    <span class="d-title">Drive</span>
                                    <span class="d-value"><?php echo $car_details['drive'] ?></span>
                                </div>
                                <div class="d-row">
                                    <span class="d-title">Fuel Economy</span>
                                    <span class="d-value"><?php echo $car_details['fuel_economy'] ?></span>
                                </div>
                                <div class="d-row">
                                    <span class="d-title">Exterior Color</span>
                                    <span class="d-value"><?php echo $car_details['exterior_color'] ?></span>
                                </div>
                                <div class="d-row">
                                    <span class="d-title">Interior Color</span>
                                    <span class="d-value"><?php echo $car_details['interior_color'] ?></span>
                                </div>
                            </div>

                            <div class="spacer-single"></div>
                        </div>

                        <div class="col-lg-3">
                            <div class="de-price text-center">
                                Daily rate
                                <h3>$<?php echo formatPrice($car_details['total_price']) ?></h3>
                            </div>
                            <div class="spacer-30"></div>

                            <div class="de-box">
                                <h4>Share</h4>
                                <div class="de-color-icons">
                                    <span><i class="fa fa-twitter fa-lg"></i></span>
                                    <span><i class="fa fa-facebook fa-lg"></i></span>
                                    <span><i class="fa fa-reddit fa-lg"></i></span>
                                    <span><i class="fa fa-linkedin fa-lg"></i></span>
                                    <span><i class="fa fa-pinterest fa-lg"></i></span>
                                    <span><i class="fa fa-stumbleupon fa-lg"></i></span>
                                    <span><i class="fa fa-delicious fa-lg"></i></span>
                                    <span><i class="fa fa-envelope fa-lg"></i></span>
                                </div>
                            </div>
                            <div class="spacer-single"></div>
                            <div>
                                <h4>Features</h4>
                                <ul class="ul-style-2">
                                    <li>Bluetooth</li>
                                    <li>Multimedia Player</li>
                                    <li>Central Lock</li>
                                    <li>Sunroof</li>
                                </ul>
                            </div>
                            <a href="admin.php" class="btn btn-secondary">Return To Admin Page</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- content close -->

        <a href="#" id="back-to-top"></a>
    </div>

    <!-- Javascript Files ================================================== -->
    <script src="js/plugins.js"></script>
    <script src="js/designesia.js"></script>

</body>

</html>