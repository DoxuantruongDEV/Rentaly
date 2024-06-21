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
    <!-- CSS Files
    ================================================== -->
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
                <img src="images/background/14.jpg" class="jarallax-img" alt="">
                <div class="center-y relative text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h1>Dashboard</h1>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- section close -->

            <section id="section-cars" class="bg-gray-100">
                <div class="container">
                    <div class="row">
                        <?php include("profile_users.php") ?>

                        <div class="col-lg-9">

                            <div class="card padding30 rounded-5 mb25">
                                <h4>My Recent Orders</h4>
                                <table class="table de-table">
                                    <thead>
                                        <tr>
                                            <th scope="col"><span class="fs-12 text-gray">Order ID</span></th>
                                            <th scope="col"><span class="fs-12 text-gray">Car Name</span></th>
                                            <th scope="col"><span class="fs-12 text-gray">Pick Up Location</span></th>
                                            <th scope="col"><span class="fs-12 text-gray">Drop Off Location</span></th>
                                            <th scope="col"><span class="fs-12 text-gray">Pick Up Date</span></th>
                                            <th scope="col"><span class="fs-12 text-gray">Return Date</span></th>
                                            <th scope="col"><span class="fs-12 text-gray">Status</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php include('trans_history.php') ?>

                                    </tbody>
                                </table>
                            </div>
                            <div class="card padding30 rounded-5">
                                <h4>My Favorites</h4>
                                <div class="spacer-10"></div>
                                <?php include("my_favorite.php") ?>
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


    <!-- Javascript Files
    ================================================== -->
    <script src="js/plugins.js"></script>
    <script src="js/designesia.js"></script>

</body>

</html>