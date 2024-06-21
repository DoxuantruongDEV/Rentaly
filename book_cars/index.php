<!DOCTYPE html>
<html lang="zxx">
<!-- Mirrored from www.madebydesignesia.com/themes/rentaly/index-5.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 17 May 2024 07:16:16 GMT -->

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
    <div class="no-bottom no-top" id="content">
      <div id="top"></div>
      <section id="section-hero" aria-label="section" class="jarallax text-light full-height vertical-center">
        <img src="images/background/6.jpg" class="jarallax-img" alt="" />
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-6">
              <div class="spacer-double"></div>
              <div class="spacer-10"></div>
              <h1>Explore the world with comfortable car</h1>
              <p class="lead">
                Embark on unforgettable adventures and discover the world in
                unparalleled comfort and style with our fleet of exceptionally
                comfortable cars.
              </p>

              <div class="row">
                <div class="col-lg-6">
                  <div class="box-icon s2 p-small mb20">
                    <i class="fa bg-color fa-trophy"></i>
                    <div class="d-inner">
                      <h4 class="id-color">First class services</h4>
                      Est dolore ut laboris eu enim eu veniam nostrud esse
                      laborum duis
                    </div>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="box-icon s2 p-small mb20">
                    <i class="fa bg-color fa-road"></i>
                    <div class="d-inner">
                      <h4 class="id-color">24/7 road assistance</h4>
                      Est dolore ut laboris eu enim eu veniam nostrud esse
                      laborum duis
                    </div>
                  </div>
                </div>
              </div>

              <a class="btn-main btn-main" href="cars.php">Choose a Car</a>
            </div>
          </div>
        </div>
      </section>

      <section id="section-cars">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-6 offset-lg-3 text-center">
              <h2>Our Vehicle Fleet</h2>
              <p>
                Driving your dreams to reality with an exquisite fleet of
                versatile vehicles for unforgettable journeys.
              </p>
              <div class="spacer-20"></div>
            </div>
            <div class="clearfix"></div>
            <div id="items-carousel" class="owl-carousel wow fadeIn">
              <?php include("carousel_products.php") ?>
            </div>
          </div>
        </div>
      </section>

      <section id="section-img-with-tab" data-bgcolor="#f8f8f8">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-5 offset-lg-7">
              <h2>Only Quality For Clients</h2>
              <div class="spacer-20"></div>

              <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                    Luxury
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                    Comfort
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
                    Prestige
                  </button>
                </li>
              </ul>
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                  <p>
                    We offer a meticulously curated collection of the most
                    sought-after luxury vehicles on the market. Whether you
                    prefer the sporty allure of a high-performance sports car,
                    the sophistication of a sleek and luxurious sedan, or the
                    versatility of a premium SUV, we have the perfect car to
                    match your discerning taste.
                  </p>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                  <p>
                    We prioritize your comfort and convenience throughout your
                    journey. We understand that a comfortable ride can make a
                    world of difference, whether you're embarking on a
                    business trip or enjoying a leisurely vacation. That's why
                    we offer a wide range of well-maintained, comfortable cars
                    that cater to your specific needs.
                  </p>
                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                  <p>
                    We understand that prestige goes beyond luxury. It's about
                    making a statement, embracing sophistication, and
                    indulging in the finer things in life. That's why we offer
                    an exclusive selection of prestigious cars that exude
                    elegance, style, and status.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="image-container col-md-6 pull-right" data-bgimage="url(images/background/5.jpg) center"></div>
      </section>

      <section>
        <div class="container">
          <div class="row">
            <div class="col-lg-3">
              <h2>Explore the world with comfortable car</h2>
              <div class="spacer-20"></div>
            </div>
            <div class="col-md-3">
              <i class="fa fa-trophy de-icon mb20"></i>
              <h4>First Class Services</h4>
              <p>
                Where luxury meets exceptional care, creating unforgettable
                moments and exceeding your every expectation.
              </p>
            </div>
            <div class="col-md-3">
              <i class="fa fa-road de-icon mb20"></i>
              <h4>24/7 road assistance</h4>
              <p>
                Reliable support when you need it most, keeping you on the
                move with confidence and peace of mind.
              </p>
            </div>
            <div class="col-md-3">
              <i class="fa fa-map-pin de-icon mb20"></i>
              <h4>Free Pick-Up & Drop-Off</h4>
              <p>
                Enjoy free pickup and drop-off services, adding an extra layer
                of ease to your car rental experience.
              </p>
            </div>
          </div>
        </div>
      </section>

      <section id="section-testimonials" class="no-top no-bottom">
        <div class="container">
          <div class="row">
            <div class="col-md-4">
              <div class="de-image-text">
                <div class="d-text">
                  <div class="d-quote id-color">
                    <i class="fa fa-quote-right"></i>
                  </div>
                  <h4>Excellent Service! Car Rent Service!</h4>
                  <blockquote>
                    I have been using Rentaly for my Car Rental needs for over
                    5 years now. I have never had any problems with their
                    service. Their customer support is always responsive and
                    helpful. I would recommend Rentaly to anyone looking for a
                    reliable Car Rental provider.
                    <span class="by">Stepanie Hutchkiss</span>
                  </blockquote>
                </div>
                <img src="images/testimonial/1.jpg" class="img-fluid" alt="" />
              </div>
            </div>

            <div class="col-md-4">
              <div class="de-image-text">
                <div class="d-text">
                  <div class="d-quote id-color">
                    <i class="fa fa-quote-right"></i>
                  </div>
                  <h4>Excellent Service! Car Rent Service!</h4>
                  <blockquote>
                    We have been using Rentaly for our trips needs for several
                    years now and have always been happy with their service.
                    Their customer support is Excellent Service! and they are
                    always available to help with any issues we have. Their
                    prices are also very competitive.
                    <span class="by">Jovan Reels</span>
                  </blockquote>
                </div>
                <img src="images/testimonial/2.jpg" class="img-fluid" alt="" />
              </div>
            </div>

            <div class="col-md-4">
              <div class="de-image-text">
                <div class="d-text">
                  <div class="d-quote id-color">
                    <i class="fa fa-quote-right"></i>
                  </div>
                  <h4>Excellent Service! Car Rent Service!</h4>
                  <blockquote>
                    Endorsed by industry experts, Rentaly is the Car Rental
                    solution you can trust. With years of experience in the
                    field, we provide fast, reliable and secure Car Rental
                    services.
                    <span class="by">Kanesha Keyton</span>
                  </blockquote>
                </div>
                <img src="images/testimonial/3.jpg" class="img-fluid" alt="" />
              </div>
            </div>
          </div>
        </div>
      </section>

      <section id="section-news">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-6 offset-lg-3 text-center">
              <h2>Latest News</h2>
              <p>
                Breaking news, fresh perspectives, and in-depth coverage -
                stay ahead with our latest news, insights, and analysis.
              </p>
              <div class="spacer-20"></div>
            </div>

            <div class="col-lg-4 mb10">
              <div class="bloglist s2 item">
                <div class="post-content">
                  <div class="post-image">
                    <div class="date-box">
                      <div class="m">10</div>
                      <div class="d">MAR</div>
                    </div>
                    <img alt="" src="images/news/pic-blog-1.jpg" class="lazy" />
                  </div>
                  <div class="post-text">
                    <h4>
                      <a href="news-single.php">Enjoy Best Travel Experience<span></span></a>
                    </h4>
                    <p>
                      Dolore officia sint incididunt non excepteur ea mollit
                      commodo ut enim reprehenderit cupidatat labore ad
                      laborum consectetur.
                    </p>
                    <a class="btn-main" href="#">Read More</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-4 mb10">
              <div class="bloglist s2 item">
                <div class="post-content">
                  <div class="post-image">
                    <div class="date-box">
                      <div class="m">12</div>
                      <div class="d">MAR</div>
                    </div>
                    <img alt="" src="images/news/pic-blog-2.jpg" class="lazy" />
                  </div>
                  <div class="post-text">
                    <h4>
                      <a href="news-single.php">The Future of Car Rent<span></span></a>
                    </h4>
                    <p>
                      Dolore officia sint incididunt non excepteur ea mollit
                      commodo ut enim reprehenderit cupidatat labore ad
                      laborum consectetur.
                    </p>
                    <a class="btn-main" href="#">Read More</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-4 mb10">
              <div class="bloglist s2 item">
                <div class="post-content">
                  <div class="post-image">
                    <div class="date-box">
                      <div class="m">14</div>
                      <div class="d">MAR</div>
                    </div>
                    <img alt="" src="images/news/pic-blog-3.jpg" class="lazy" />
                  </div>
                  <div class="post-text">
                    <h4>
                      <a href="news-single.php">Holiday Tips For Backpacker<span></span></a>
                    </h4>
                    <p>
                      Dolore officia sint incididunt non excepteur ea mollit
                      commodo ut enim reprehenderit cupidatat labore ad
                      laborum consectetur.
                    </p>
                    <a class="btn-main" href="#">Read More</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section id="section-call-to-action" class="bg-color text-light">
        <div class="container">
          <div class="row g-custom-x force-text-center">
            <div class="col-md-3 col-sm-6 mb-sm-30">
              <div class="de_count wow fadeInUp">
                <h3 class="timer" data-to="15425" data-speed="3000">0</h3>
                Completed Orders
                <p class="d-small">
                  Lorem ipsum adipisicing officia in adipisicing do velit sit
                  tempor ea consectetur.
                </p>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-sm-30">
              <div class="de_count wow fadeInUp">
                <h3 class="timer" data-to="8745" data-speed="3000">0</h3>
                Happy Customers
                <p class="d-small">
                  Lorem ipsum adipisicing officia in adipisicing do velit sit
                  tempor ea consectetur.
                </p>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-sm-30">
              <div class="de_count wow fadeInUp">
                <h3 class="timer" data-to="235" data-speed="3000">0</h3>
                Vehicles Fleet
                <p class="d-small">
                  Lorem ipsum adipisicing officia in adipisicing do velit sit
                  tempor ea consectetur.
                </p>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-sm-30">
              <div class="de_count wow fadeInUp">
                <h3 class="timer" data-to="15" data-speed="3000">0</h3>
                Years Experience
                <p class="d-small">
                  Lorem ipsum adipisicing officia in adipisicing do velit sit
                  tempor ea consectetur.
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section aria-label="section" class="pt40 pb40 text-light" data-bgcolor="#181818">
        <div class="wow fadeInRight d-flex">
          <div class="de-marquee-list">
            <div class="d-item">
              <span class="d-item-txt">SUV</span>
              <span class="d-item-display">
                <i class="d-item-dot"></i>
              </span>
              <span class="d-item-txt">Hatchback</span>
              <span class="d-item-display">
                <i class="d-item-dot"></i>
              </span>
              <span class="d-item-txt">Crossover</span>
              <span class="d-item-display">
                <i class="d-item-dot"></i>
              </span>
              <span class="d-item-txt">Convertible</span>
              <span class="d-item-display">
                <i class="d-item-dot"></i>
              </span>
              <span class="d-item-txt">Sedan</span>
              <span class="d-item-display">
                <i class="d-item-dot"></i>
              </span>
              <span class="d-item-txt">Sports Car</span>
              <span class="d-item-display">
                <i class="d-item-dot"></i>
              </span>
              <span class="d-item-txt">Coupe</span>
              <span class="d-item-display">
                <i class="d-item-dot"></i>
              </span>
              <span class="d-item-txt">Minivan</span>
              <span class="d-item-display">
                <i class="d-item-dot"></i>
              </span>
              <span class="d-item-txt">Station Wagon</span>
              <span class="d-item-display">
                <i class="d-item-dot"></i>
              </span>
              <span class="d-item-txt">Truck</span>
              <span class="d-item-display">
                <i class="d-item-dot"></i>
              </span>
              <span class="d-item-txt">Minivans</span>
              <span class="d-item-display">
                <i class="d-item-dot"></i>
              </span>
              <span class="d-item-txt">Exotic Cars</span>
              <span class="d-item-display">
                <i class="d-item-dot"></i>
              </span>
            </div>
          </div>

          <div class="de-marquee-list">
            <div class="d-item">
              <span class="d-item-txt">SUV</span>
              <span class="d-item-display">
                <i class="d-item-dot"></i>
              </span>
              <span class="d-item-txt">Hatchback</span>
              <span class="d-item-display">
                <i class="d-item-dot"></i>
              </span>
              <span class="d-item-txt">Crossover</span>
              <span class="d-item-display">
                <i class="d-item-dot"></i>
              </span>
              <span class="d-item-txt">Convertible</span>
              <span class="d-item-display">
                <i class="d-item-dot"></i>
              </span>
              <span class="d-item-txt">Sedan</span>
              <span class="d-item-display">
                <i class="d-item-dot"></i>
              </span>
              <span class="d-item-txt">Sports Car</span>
              <span class="d-item-display">
                <i class="d-item-dot"></i>
              </span>
              <span class="d-item-txt">Coupe</span>
              <span class="d-item-display">
                <i class="d-item-dot"></i>
              </span>
              <span class="d-item-txt">Minivan</span>
              <span class="d-item-display">
                <i class="d-item-dot"></i>
              </span>
              <span class="d-item-txt">Station Wagon</span>
              <span class="d-item-display">
                <i class="d-item-dot"></i>
              </span>
              <span class="d-item-txt">Truck</span>
              <span class="d-item-display">
                <i class="d-item-dot"></i>
              </span>
              <span class="d-item-txt">Minivans</span>
              <span class="d-item-display">
                <i class="d-item-dot"></i>
              </span>
              <span class="d-item-txt">Exotic Cars</span>
              <span class="d-item-display">
                <i class="d-item-dot"></i>
              </span>
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

<!-- Mirrored from www.madebydesignesia.com/themes/rentaly/index-5.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 17 May 2024 07:16:33 GMT -->

</html>

<link rel="stylesheet" href="./css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="./fonts/font-awesome/css/font-awesome.css" type="text/css" />
<link rel="stylesheet" href="../assets/css/app.css" type="text/css" />