<!DOCTYPE html>
<html lang="zxx">
<!-- Mirrored from www.madebydesignesia.com/themes/rentaly/index-5.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 17 May 2024 07:16:16 GMT -->

<head>
  <title>Rentaly - Multipurpose Vehicle Car Rental Website Template</title>
  <link rel="icon" href="images/icon.png" type="image/gif" sizes="16x16" />
  <meta content="text/html;charset=utf-8" http-equiv="Content-Type" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta content="Rentaly - Multipurpose Vehicle Car Rental Website Template" name="description" />
  <meta content="" name="keywords" />
  <meta content="" name="author" />
  <!-- CSS Files
    ================================================== -->
  <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap" />
  <link href="css/mdb.min.css" rel="stylesheet" type="text/css" id="mdb" />
  <link href="css/plugins.css" rel="stylesheet" type="text/css" />
  <link href="css/style.css" rel="stylesheet" type="text/css" />
  <link href="css/coloring.css" rel="stylesheet" type="text/css" />
  <!-- color scheme -->
  <link id="colors" href="css/colors/scheme-01.css" rel="stylesheet" type="text/css" />
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
      <section id="subheader" class="jarallax text-light">
        <img src="images/background/paycars.jpg" class="jarallax-img" alt="" />
        <div class="center-y relative text-center">
          <div class="container">
            <div class="row">
              <div class="col-md-12 text-center">
                <h1>Fast transaction</h1>
              </div>
              <div class="clearfix"></div>
            </div>
          </div>
        </div>
      </section>
      <section>
        <main role="main">
          <div class="container mt-4">
            <form class="needs-validation" name="frmthanhtoan" method="post" action="#">
              <input type="hidden" name="kh_tendangnhap" value="dnpcuong" />

              <div class="py-5 text-center">
                <i class="fa fa-credit-card fa-4x" aria-hidden="true"></i>
                <h2>Thanh toán</h2>
                <p class="lead">
                  Vui lòng kiểm tra thông tin Khách hàng, thông tin Giỏ hàng trước
                  khi Thanh toán.
                </p>
              </div>

              <div class="row">
                <div class="col-md-4 order-md-2 mb-4">
                  <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Giỏ hàng</span>
                    <span class="badge badge-secondary badge-pill">1</span>
                  </h4>
                  <ul class="list-group mb-3">
                    <input type="hidden" name="sanphamgiohang[1][sp_ma]" />
                    <input type="hidden" name="sanphamgiohang[1][gia]" />
                    <input type="hidden" name="sanphamgiohang[1][soluong]" />

                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                      <div>
                        <h6 class="my-0">Xe Toyota XN400</h6>
                        <small class="text-muted">Hãng camry</small>
                      </div>
                      <span class="text-muted">23600$</span>
                    </li>
                    <input type="hidden" name="sanphamgiohang[2][sp_ma]" />
                    <input type="hidden" name="sanphamgiohang[2][gia]" />
                    <input type="hidden" name="sanphamgiohang[2][soluong]" />
                  </ul>

                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Mã khuyến mãi" />
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-secondary">
                        Xác nhận
                      </button>
                    </div>
                  </div>
                </div>
                <div class="col-md-8 order-md-1">
                  <h4 class="mb-3">Thông tin khách hàng</h4>

                  <div class="row">
                    <div class="col-md-12">
                      <label for="kh_ten">Họ tên</label>
                      <input type="text" class="form-control" name="kh_ten" id="kh_ten" readonly="" />
                    </div>
                    <div class="col-md-12">
                      <label for="kh_gioitinh">Giới tính</label>
                      <input type="text" class="form-control" name="kh_gioitinh" id="kh_gioitinh" readonly="" />
                    </div>
                    <div class="col-md-12">
                      <label for="kh_diachi">Địa chỉ</label>
                      <input type="text" class="form-control" name="kh_diachi" id="kh_diachi" readonly="" />
                    </div>

                  </div>

                  <h4 class="mb-3">Hình thức thanh toán</h4>

                  <div class="d-block my-3">
                    <div class="custom-control custom-radio">
                      <input id="httt-2" name="httt_ma" type="radio" class="custom-control-input" required="" />
                      <label class="custom-control-label" for="httt-2">Chuyển khoản <small>(Momo)</small></label>
                    </div>
                    <div class="custom-control custom-radio">
                      <input id="httt-3" name="httt_ma" type="radio" class="custom-control-input" required="" />
                      <label class="custom-control-label" for="httt-3">Thẻ ATM <small>(Momo)</small> </label>
                    </div>
                  </div>
                  <hr class="mb-4" />
                  <button class="btn btn-primary btn-lg btn-block" type="submit" name="btnDatHang">
                    Thanh toán
                  </button>
                </div>
              </div>
            </form>
          </div>
        </main>
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