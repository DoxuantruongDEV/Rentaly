<?php
session_start();
require_once 'config/config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $name = $_POST['name'];
    $rePassword = $_POST['re-password'];
    $password = $_POST['password'];

    // Kiểm tra xem email đã tồn tại trong cơ sở dữ liệu chưa
    $check_email_query = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($check_email_query);
    if ($result->num_rows > 0) {
        echo '<div class="toast error">';
        echo '<i class="fas fa-exclamation-triangle"></i>';
        echo '<span class="msg">Email của bạn đã tồn tại trong dữ liệu!</span>';
        echo '</div>';

        echo '<script>
             document.addEventListener("DOMContentLoaded", function () {
                 const toast = document.querySelector(".toast");
                 setTimeout(function () {
                     toast.style.display = "none";
                 }, 2000);
             });
          </script>';
    } else {
        // Email không tồn tại, thực hiện truy vấn INSERT
        $sql = "INSERT INTO users (username, email, phone, name, password) VALUES ('$username', '$email', '$phone', '$name', '$password')";
        if ($conn->query($sql) === TRUE) {
            echo '<div class="toast success">';
            echo '<i class="fas fa-check-circle"></i>';
            echo '<span class="msg">Đăng ký thành công!</span>';
            echo '</div>';
            echo '<script>
                     document.addEventListener("DOMContentLoaded", function () {
                         const toast = document.querySelector(".toast");
                         setTimeout(function () {
                             toast.style.display = "none";
                         }, 2000);
                     });
                  </script>';
            // Chuyển hướng sau khi xử lý dữ liệu
            header("Location: login.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
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
    <!-- CSS Files -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap">
    <link href="css/mdb.min.css" rel="stylesheet" type="text/css" id="mdb">
    <link href="css/plugins.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/coloring.css" rel="stylesheet" type="text/css">
    <!-- color scheme -->
    <link id="colors" href="css/colors/scheme-01.css" rel="stylesheet" type="text/css">
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const form = document.querySelector('#contact_form');
            form.addEventListener('submit', function(event) {
                const password = document.querySelector('#password').value;
                const rePassword = document.querySelector('#re-password').value;

                if (password !== rePassword) {
                    event.preventDefault();
                    alert('Passwords do not match!');
                }
            });
        });
    </script>
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

            <!-- section begin -->
            <section id="subheader" class="jarallax text-light">
                <img src="images/background/subheader.jpg" class="jarallax-img" alt="">
                <div class="center-y relative text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h1>Register</h1>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- section close -->

            <section aria-label="section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <h3>Don't have an account? Register now.</h3>
                            <p>Welcome to Rentaly. We're excited to have you on board. By creating an account with us,
                                you'll gain access to a range of benefits and convenient features that will enhance your
                                car rental experience.</p>

                            <div class="spacer-10"></div>

                            <form name="contactForm" id='contact_form' class="form-border" method="post" action='#'>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="field-set">
                                            <label>Name:</label>
                                            <input type='text' name='name' id='name' class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="field-set">
                                            <label>Email:</label>
                                            <input type='text' name='email' id='email' class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="field-set">
                                            <label>Username:</label>
                                            <input type='text' name='username' id='username' class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="field-set">
                                            <label>Phone:</label>
                                            <input type='text' name='phone' id='phone' class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="field-set">
                                            <label>Password:</label>
                                            <input type='password' name='password' id='password' class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="field-set">
                                            <label>Re-enter Password:</label>
                                            <input type='password' name='re-password' id='re-password' class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">

                                        <div id='submit' class="pull-left">
                                            <input type='submit' id='send_message' value='Register Now' class="btn-main color-2">
                                        </div>

                                        <div id='mail_success' class='success'>Your message has been sent successfully.
                                        </div>
                                        <div id='mail_fail' class='error'>Sorry, error occured this time sending your
                                            message.</div>
                                        <div class="clearfix"></div>

                                    </div>

                                </div>
                            </form>

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

    <!-- Javascript Files -->
    <script src="js/plugins.js"></script>
    <script src="js/designesia.js"></script>

</body>

</html>