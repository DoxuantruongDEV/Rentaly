<!DOCTYPE html>
<html lang="zxx">
<!-- Mirrored from www.madebydesignesia.com/themes/rentaly/account-booking.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 17 May 2024 07:16:55 GMT -->

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
                <h1>My Orders</h1>
              </div>
              <div class="clearfix"></div>
            </div>
          </div>
        </div>
      </section>
      <!-- section close -->

      <section id="section-settings" class="bg-gray-100">
        <div class="container">
          <div class="row">
            <?php include("profile_users.php") ?>
            <div class="col-lg-9">

              <div class="card padding30 rounded-5 mb25">
                <h4>Scheduled Orders</h4>

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
                    <?php include('scheduled_orders.php') ?>
                  </tbody>
                </table>
              </div>

              <div class="card padding30 rounded-5 mb25">
                <h4>Completed Orders</h4>

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
                    <?php include('completed_orders.php') ?>
                  </tbody>
                </table>
              </div>

              <div class="card padding30 rounded-5 mb25">
                <h4>Cancelled Orders</h4>
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
                    <?php include('cancelled_orders.php') ?>

                  </tbody>
                </table>
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


<!-- Mirrored from www.madebydesignesia.com/themes/rentaly/account-booking.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 17 May 2024 07:16:55 GMT -->

</html>