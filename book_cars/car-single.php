<?php
require_once 'config/config.php'; // Connect to the database

// Initialize the $row variable before using it
$row = [];

// Check if the session has started and start it if not
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

// Check if cars_id is set in the URL
$cars_id = isset($_GET['cars_id']) ? $_GET['cars_id'] : null;

// Fetch car details based on cars_id
if ($cars_id) {
    $car_sql = "SELECT 
                    ci.front_image,
                    ci.rear_image,
                    ci.right_image,
                    ci.left_image,
                    c.name,
                    c.body,
                    c.seat,
                    c.door,
                    c.luggage,
                    cd.fuel_type,
                    cd.engine_capacity,
                    cd.year,
                    cd.description,
                    cd.mileage,
                    cd.transmission,
                    cd.drive,
                    cd.fuel_economy,
                    cd.exterior_color,
                    cd.interior_color,
                    cd.total_price,
                    f.feature_name
                FROM 
                    cars_image ci
                JOIN 
                    cars c ON ci.car_id = c.id
                JOIN 
                    cars_details cd ON ci.car_id = cd.car_id
                JOIN 
                    features f ON ci.car_id = f.car_id
                WHERE 
                    ci.car_id = ?;";

    $car_stmt = $conn->prepare($car_sql);
    $car_stmt->bind_param("i", $cars_id);
    $car_stmt->execute();
    $car_result = $car_stmt->get_result();
    if ($car_result && $car_result->num_rows > 0) {
        $row = $car_result->fetch_assoc();
    } else {
        echo '<span class="msg">An error occurred while fetching the product!</span>';
    }
} else {
    echo '<span class="msg">No cars_id provided in the URL!</span>';
}

// Function to format the price
function formatPrice($price)
{
    return (strpos($price, '.00') !== false) ? rtrim(rtrim($price, '0'), '.') : $price;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Rentaly - Multipurpose Vehicle Car Rental Website Template</title>
    <link rel="icon" href="images/icon.png" type="image/gif" sizes="16x16">
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Rentaly - Multipurpose Vehicle Car Rental Website Template" name="description">
    <meta content="" name="keywords">
    <meta content="" name="author">
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap">
    <link href="css/mdb.min.css" rel="stylesheet" type="text/css" id="mdb">
    <link href="css/plugins.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/coloring.css" rel="stylesheet" type="text/css">
    <link id="colors" href="css/colors/scheme-01.css" rel="stylesheet" type="text/css">
    <div id="fb-root"></div>
</head>

<body>
    <div id="wrapper">
        <div id="de-preloader"></div>
        <?php include('header.php') ?>
        <div class="no-bottom no-top zebra" id="content">
            <div id="top"></div>

            <section id="subheader" class="jarallax text-light">
                <img src="images/background/2.jpg" class="jarallax-img" alt="">
                <div class="center-y relative text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h1>Vehicle Fleet</h1>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="section-car-details">
                <div class="container">
                    <div class="row g-5">
                        <div class="col-lg-6">
                            <div id="slider-carousel" class="owl-carousel">
                                <div class="item"><img src="<?php echo $row['front_image'] ?>" alt=""></div>
                                <div class="item"><img src="<?php echo $row['rear_image'] ?>" alt=""></div>
                                <div class="item"><img src="<?php echo $row['right_image'] ?>" alt=""></div>
                                <div class="item"><img src="<?php echo $row['left_image'] ?>" alt=""></div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <h3><?php echo $row['name'] ?></h3>
                            <p><?php echo $row['description'] ?></p>
                            <div class="spacer-10"></div>
                            <h4>Specifications</h4>
                            <div class="de-spec">
                                <?php
                                $specs = [
                                    'Body' => $row['body'],
                                    'Seat' => $row['seat'],
                                    'Door' => $row['door'],
                                    'Luggage' => $row['luggage'],
                                    'Fuel Type' => $row['fuel_type'],
                                    'Engine' => $row['engine_capacity'],
                                    'Year' => $row['year'],
                                    'Mileage' => $row['mileage'],
                                    'Transmission' => $row['transmission'],
                                    'Drive' => $row['drive'],
                                    'Fuel Economy' => $row['fuel_economy'],
                                    'Exterior Color' => $row['exterior_color'],
                                    'Interior Color' => $row['interior_color']
                                ];

                                foreach ($specs as $key => $value) {
                                    echo "<div class='d-row'><span class='d-title'>{$key}</span><span class='d-value'>{$value}</span></div>";
                                }
                                ?>
                            </div>

                            <div class="spacer-single"></div>

                            <h4>Features</h4>
                            <ul class="ul-style-2">
                                <li><?php echo $row['feature_name'] ?></li>
                            </ul>
                        </div>

                        <div class="col-lg-3">
                            <div class="de-price text-center">
                                Daily rate
                                <h3>$<?php echo formatPrice($row['total_price']) ?></h3>
                            </div>

                            <input type="hidden" id="carTotalPrice" name="carTotalPrice" value="<?php echo $row['total_price'] ?>">

                            <div class="spacer-30"></div>
                            <div class="de-box mb25">
                                <form name="contactForm" id="paymentForm" method="post">
                                    <h4>Booking this car</h4>

                                    <div class="spacer-20"></div>

                                    <div class="row">
                                        <div class="col-lg-12 mb20">
                                            <h5>Pick Up Location</h5>
                                            <input type="text" name="PickupLocation" onfocus="geolocate()" placeholder="Enter your pickup location" id="autocomplete" autocomplete="off" class="form-control" required>
                                        </div>

                                        <div class="col-lg-12 mb20">
                                            <h5>Drop Off Location</h5>
                                            <input type="text" name="DropoffLocation" onfocus="geolocate()" placeholder="Enter your dropoff location" id="autocomplete2" autocomplete="off" class="form-control" required>
                                        </div>

                                        <div class="col-lg-12 mb20">
                                            <h5>Pick Up Date & Time</h5>
                                            <div class="date-time-field">
                                                <input type="text" id="date-picker" name="PickUpDate" value="">
                                                <select name="PickUpTime" id="pickup-time">
                                                    <option selected disabled value="Select time">Time</option>
                                                    <option value="00:00">00:00</option>
                                                    <option value="00:30">00:30</option>
                                                    <option value="01:00">01:00</option>
                                                    <option value="01:30">01:30</option>
                                                    <option value="02:00">02:00</option>
                                                    <option value="02:30">02:30</option>
                                                    <option value="03:00">03:00</option>
                                                    <option value="03:30">03:30</option>
                                                    <option value="04:00">04:00</option>
                                                    <option value="04:30">04:30</option>
                                                    <option value="05:00">05:00</option>
                                                    <option value="05:30">05:30</option>
                                                    <option value="06:00">06:00</option>
                                                    <option value="06:30">06:30</option>
                                                    <option value="07:00">07:00</option>
                                                    <option value="07:30">07:30</option>
                                                    <option value="08:00">08:00</option>
                                                    <option value="08:30">08:30</option>
                                                    <option value="09:00">09:00</option>
                                                    <option value="09:30">09:30</option>
                                                    <option value="10:00">10:00</option>
                                                    <option value="10:30">10:30</option>
                                                    <option value="11:00">11:00</option>
                                                    <option value="11:30">11:30</option>
                                                    <option value="12:00">12:00</option>
                                                    <option value="12:30">12:30</option>
                                                    <option value="13:00">13:00</option>
                                                    <option value="13:30">13:30</option>
                                                    <option value="14:00">14:00</option>
                                                    <option value="14:30">14:30</option>
                                                    <option value="15:00">15:00</option>
                                                    <option value="15:30">15:30</option>
                                                    <option value="16:00">16:00</option>
                                                    <option value="16:30">16:30</option>
                                                    <option value="17:00">17:00</option>
                                                    <option value="17:30">17:30</option>
                                                    <option value="18:00">18:00</option>
                                                    <option value="18:30">18:30</option>
                                                    <option value="19:00">19:00</option>
                                                    <option value="19:30">19:30</option>
                                                    <option value="20:00">20:00</option>
                                                    <option value="20:30">20:30</option>
                                                    <option value="21:00">21:00</option>
                                                    <option value="21:30">21:30</option>
                                                    <option value="22:00">22:00</option>
                                                    <option value="22:30">22:30</option>
                                                    <option value="23:00">23:00</option>
                                                    <option value="23:30">23:30</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 mb20">
                                            <h5>Return Date & Time</h5>
                                            <div class="date-time-field">
                                                <input type="text" id="date-picker-2" name="ReturnDate" value="">
                                                <select name="CollectionTime" id="collection-time">
                                                    <option selected disabled value="Select time">Time</option>
                                                    <option value="00:00">00:00</option>
                                                    <option value="00:30">00:30</option>
                                                    <option value="01:00">01:00</option>
                                                    <option value="01:30">01:30</option>
                                                    <option value="02:00">02:00</option>
                                                    <option value="02:30">02:30</option>
                                                    <option value="03:00">03:00</option>
                                                    <option value="03:30">03:30</option>
                                                    <option value="04:00">04:00</option>
                                                    <option value="04:30">04:30</option>
                                                    <option value="05:00">05:00</option>
                                                    <option value="05:30">05:30</option>
                                                    <option value="06:00">06:00</option>
                                                    <option value="06:30">06:30</option>
                                                    <option value="07:00">07:00</option>
                                                    <option value="07:30">07:30</option>
                                                    <option value="08:00">08:00</option>
                                                    <option value="08:30">08:30</option>
                                                    <option value="09:00">09:00</option>
                                                    <option value="09:30">09:30</option>
                                                    <option value="10:00">10:00</option>
                                                    <option value="10:30">10:30</option>
                                                    <option value="11:00">11:00</option>
                                                    <option value="11:30">11:30</option>
                                                    <option value="12:00">12:00</option>
                                                    <option value="12:30">12:30</option>
                                                    <option value="13:00">13:00</option>
                                                    <option value="13:30">13:30</option>
                                                    <option value="14:00">14:00</option>
                                                    <option value="14:30">14:30</option>
                                                    <option value="15:00">15:00</option>
                                                    <option value="15:30">15:30</option>
                                                    <option value="16:00">16:00</option>
                                                    <option value="16:30">16:30</option>
                                                    <option value="17:00">17:00</option>
                                                    <option value="17:30">17:30</option>
                                                    <option value="18:00">18:00</option>
                                                    <option value="18:30">18:30</option>
                                                    <option value="19:00">19:00</option>
                                                    <option value="19:30">19:30</option>
                                                    <option value="20:00">20:00</option>
                                                    <option value="20:30">20:30</option>
                                                    <option value="21:00">21:00</option>
                                                    <option value="21:30">21:30</option>
                                                    <option value="22:00">22:00</option>
                                                    <option value="22:30">22:30</option>
                                                    <option value="23:00">23:00</option>
                                                    <option value="23:30">23:30</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="spacer-20"></div>
                                    <h5>Payment Method <small>(Momo)</small></h5>
                                    <div class="mb20">
                                        <div class="mb20" style="display: flex; justify-content: space-between;">
                                            <div class="form-check">
                                                <label class="form-check-label" for="momo_atm">
                                                    <img src="images/png/atm-card.png" alt="" class="img-fluid me-2" style="height: 2rem; width: 2rem;">
                                                </label>
                                                <input class="form-check-input" type="radio" name="payment_method" id="momo_atm" value="momo_atm" style="margin-top: 5px;">
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label" for="momo_qr">
                                                    <img src="images/png/qr-scan.png" alt="" class="img-fluid me-2" style="height: 2rem; width: 2rem;">
                                                </label>
                                                <input class="form-check-input" type="radio" name="payment_method" id="momo_qr" value="momo_qr" style="margin-top: 5px;">
                                            </div>
                                        </div>
                                        <input type='submit' id='submitBtn' value='Book Now' class="btn-main btn-fullwidth">

                                        <div class="clearfix"></div>
                                    </div>
                                </form>
                            </div>

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
                        </div>
                    </div>
                </div>
            </section>

            <a href="#" id="back-to-top"></a>
        </div>
    </div>
    <script src="js/plugins.js"></script>
    <script src="js/designesia.js"></script>

    <script>
        document.getElementById('paymentForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const paymentMethod = document.querySelector('input[name="payment_method"]:checked');
            if (!paymentMethod) {
                alert('Please select a payment method');
                return;
            }

            // Get values from input fields
            const pickupLocation = document.getElementsByName('PickupLocation')[0].value;
            const dropoffLocation = document.getElementsByName('DropoffLocation')[0].value;
            const pickUpDate = document.getElementsByName('PickUpDate')[0].value;
            const returnDate = document.getElementsByName('ReturnDate')[0].value;
            const pickUpTime = document.getElementById('pickup-time').value;
            const returnTime = document.getElementById('collection-time').value;
            const carTotalPriceUSD = parseFloat(document.getElementById('carTotalPrice').value);

            // Convert USD to VND
            const usdToVndRate = 23000;
            const carTotalPriceVND = Math.floor(carTotalPriceUSD * usdToVndRate);

            // Build URL with parameters
            const momoUrl = 'http://localhost/Rentaly/book_cars/momo_atm.php';
            const redirectUrl = `${momoUrl}?car_id=<?php echo $cars_id ?>&amount=${carTotalPriceVND}&payment_method=${paymentMethod.value}&PickupLocation=${encodeURIComponent(pickupLocation)}&DropoffLocation=${encodeURIComponent(dropoffLocation)}&PickUpDate=${encodeURIComponent(pickUpDate)}&ReturnDate=${encodeURIComponent(returnDate)}&PickUpTime=${encodeURIComponent(pickUpTime)}&ReturnTime=${encodeURIComponent(returnTime)}`;

            // Redirect user to Momo
            window.location.href = redirectUrl;
        });
    </script>


</body>

</html>