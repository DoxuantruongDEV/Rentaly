<?php
session_start();
include('config/config.php');
$isUserLoggedIn = isset($_SESSION['user_id']);

$userFavorites = [];
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT car_id FROM user_favorites WHERE user_id = $user_id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $userFavorites[] = $row['car_id'];
    }
}
?>
<script>
    const userFavorites = <?php echo json_encode($userFavorites); ?>;
    localStorage.setItem('favorites', JSON.stringify(userFavorites));
    const isUserLoggedIn = <?php echo json_encode($isUserLoggedIn); ?>;
</script>
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
    <!-- CSS Files -->
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
        <?php include('header.php') ?>
        <!-- header close -->

        <!-- content begin -->
        <div class="no-bottom no-top zebra" id="content">
            <div id="top"></div>

            <!-- section begin -->
            <section id="subheader" class="jarallax text-light">
                <img src="images/background/2.jpg" class="jarallax-img" alt="">
                <div class="center-y relative text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h1>Cars</h1>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- section close -->

            <section id="section-cars">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <?php include('function_cars.php') ?>
                        </div>
                        <div class=" col-lg-9">
                            <div class="row">
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
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- content close -->

        <a href="#" id="back-to-top"></a>

        <!-- footer begin -->
        <?php include("footer.php") ?>
        <!-- footer close -->

    </div>

    <!-- Defer loading of non-essential JavaScript files -->
    <script defer src="js/plugins.js"></script>
    <script defer src="js/designesia.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const favoriteButtons = document.querySelectorAll('.favorite-btn');
            const favorites = JSON.parse(localStorage.getItem('favorites')) || [];

            const showMessage = (message) => {
                const messageBox = document.createElement('div');
                messageBox.textContent = message;
                messageBox.style.position = 'fixed';
                messageBox.style.bottom = '20px';
                messageBox.style.left = '50%';
                messageBox.style.transform = 'translateX(-50%)';
                messageBox.style.backgroundColor = '#4caf50';
                messageBox.style.color = '#fff';
                messageBox.style.padding = '10px 20px';
                messageBox.style.borderRadius = '5px';
                messageBox.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
                document.body.appendChild(messageBox);
                setTimeout(() => {
                    messageBox.remove();
                }, 1000);
            };

            document.body.addEventListener('click', function(event) {
                if (event.target.classList.contains('favorite-btn')) {
                    if (!isUserLoggedIn) {
                        alert('You must be logged in to favorite cars.');
                        return;
                    }

                    const carId = event.target.getAttribute('data-car-id');
                    if (favorites.includes(carId)) {
                        const index = favorites.indexOf(carId);
                        favorites.splice(index, 1);
                        event.target.classList.remove('favorite');
                        showMessage('Car removed from favorites.');
                    } else {
                        favorites.push(carId);
                        event.target.classList.add('favorite');
                        showMessage('Car added to favorites.');
                    }
                    localStorage.setItem('favorites', JSON.stringify(favorites));
                    if (isUserLoggedIn) {
                        syncFavoritesWithDatabase(favorites);
                    }
                }
            });

            function syncFavoritesWithDatabase(favorites) {
                fetch('sync_favorites.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            favorites: favorites
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log('Favorites synced successfully');
                        } else {
                            console.error('Failed to sync favorites');
                        }
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                    });
            }
        });
    </script>
</body>

</html>