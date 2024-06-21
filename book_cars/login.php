<?php
session_start();

require_once 'config/config.php'; // Kết nối cơ sở dữ liệu
if (isset($_POST['btnlogin'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  // Truy vấn cơ sở dữ liệu để tìm người dùng với tên đăng nhập cụ thể
  $query = "SELECT * FROM users WHERE email = ? AND password = ?";
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, "ss", $email, $password); // Chỉnh sửa đây để pass cả password vào

  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($result);

  if ($row) {
    $_SESSION['user'] = $email; // Lưu tên người dùng vào session
    $_SESSION['user_id'] = $row['id']; // Lưu ID người dùng vào session 
    $_SESSION['role'] = $row['role']; // Lưu quyền người dùng vào session

    if ($_SESSION['role'] == 'admin') {
      header("Location: admin.php");
    } else {
      header("Location: index.php");
    }
    exit();
  } else {
    echo '<div class="toast error">';
    echo '<i class="fa-solid fa-circle-exclamation"></i>';
    echo '<span class="msg">Tên hoặc mật khẩu không đúng!</span>';
    echo '</div>';

    echo '<script>
             document.addEventListener("DOMContentLoaded", function () {
                 const toast = document.querySelector(".toast");
                 setTimeout(function () {
                     toast.style.display = "none";
                 }, 2000);
             });
          </script>';
  }
}
?>
<!DOCTYPE html>
<html>

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
    <?php include('header.php'); ?>
    <!-- header close -->
    <!-- content begin -->
    <div class="no-bottom no-top" id="content">
      <div id="top"></div>
      <section id="section-hero" aria-label="section" class="jarallax">
        <img src="images/background/2.jpg" class="jarallax-img" alt="">
        <div class="v-center">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-lg-4 offset-lg-4">
                <div class="padding40 rounded-3 shadow-soft" data-bgcolor="#ffffff">
                  <h4>Login</h4>
                  <div class="spacer-10"></div>
                  <form id="form_register" class="form-border" method="post" action="#">
                    <div class="field-set">
                      <input type="text" name="email" id="email" class="form-control" placeholder="Email" />
                    </div>
                    <div class="field-set">
                      <input type="text" name="password" id="password" class="form-control" placeholder="Password" />
                    </div>
                    <div id="submit">
                      <input type="submit" id="send_message" name="btnlogin" value="Sign In" class="btn-main btn-fullwidth rounded-3" />
                    </div>
                  </form>
                  <div class="title-line">Or&nbsp;sign&nbsp;up&nbsp;with</div>
                  <div class="row g-2">
                    <div class="col-lg-6">
                      <a class="btn-sc btn-fullwidth mb10" href="register.php"><img src="images/png/profile.png" alt="">Register now</a>
                    </div>
                    <div class="col-lg-6">
                      <a class="btn-sc btn-fullwidth mb10" href="forgot_password.php"><img src="images/png/lock.png" alt="">Forgot
                        password</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    <!-- content close -->
    <?php include("footer.php"); ?>

    <!-- Javascript Files
    ================================================== -->
    <script src="js/plugins.js"></script>
    <script src="js/designesia.js"></script>
  </div>

</body>

</html>