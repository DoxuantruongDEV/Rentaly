<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('config/config.php');

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
// Fetch user information if the user is logged in
if ($user_id) {
    $user_sql = "SELECT username, email, avatar FROM users WHERE id = ?";
    $user_stmt = $conn->prepare($user_sql);
    $user_stmt->bind_param("i", $user_id);
    $user_stmt->execute();
    $user_result = $user_stmt->get_result();
    if ($user_result->num_rows > 0) {
        $user_info = $user_result->fetch_assoc();
    } else {
        $user_info = [];
    }
}
// Debugging: print session data
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
?>

<header class="transparent scroll-light has-topbar">
    <div id="topbar" class="topbar-dark text-light">
        <div class="container">
            <div class="topbar-left xs-hide">
                <div class="topbar-widget">
                    <a href="#"><i class="fa fa-phone"></i>+208 333 9296</a>
                </div>
                <div class="topbar-widget">
                    <a href="#"><i class="fa fa-envelope"></i>contact@rentaly.com</a>
                </div>
                <div class="topbar-widget">
                    <a href="#"><i class="fa fa-clock-o"></i>Mon - Fri 08.00 - 18.00</a>
                </div>
            </div>
            <div class="topbar-right">
                <div class="social-icons">
                    <a href="#"><i class="fa fa-facebook fa-lg"></i></a>
                    <a href="#"><i class="fa fa-twitter fa-lg"></i></a>
                    <a href="#"><i class="fa fa-youtube fa-lg"></i></a>
                    <a href="#"><i class="fa fa-pinterest fa-lg"></i></a>
                    <a href="#"><i class="fa fa-instagram fa-lg"></i></a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="de-flex sm-pt10">
                    <div class="de-flex-col">
                        <div class="de-flex-col">
                            <!-- logo begin -->
                            <div id="logo">
                                <a href="index.php">
                                    <img class="logo-1" src="images/logo-light.png" alt="" />
                                    <img class="logo-2" src="images/logo.png" alt="" />
                                </a>
                            </div>
                            <!-- logo close -->
                        </div>
                    </div>
                    <div class="de-flex-col header-col-mid">
                        <ul id="mainmenu">
                            <li><a class="menu-item" href="index.php">Home</a></li>
                            <li>
                                <a class="menu-item" href="cars.php">Cars</a>
                                <ul>
                                    <li>
                                        <a class="menu-item" href="cars.php">Cars List</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a class="menu-item" href="quick-booking.php">Booking</a>
                            </li>
                            <?php if ($user) : ?>
                                <li>
                                    <a class="menu-item" href="account-dashboard.php">My Account</a>
                                    <ul>
                                        <li>
                                            <a class="menu-item" href="account-dashboard.php">Dashboard</a>
                                        </li>
                                        <li>
                                            <a class="menu-item" href="account-profile.php">My Profile</a>
                                        </li>
                                        <li>
                                            <a class="menu-item" href="account-booking.php">My Orders</a>
                                        </li>
                                        <li>
                                            <a class="menu-item" href="account-favorite.php">My Favorite Cars</a>
                                        </li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                            <li>
                                <a class="menu-item" href="#">Pages</a>
                                <ul>
                                    <li>
                                        <a class="menu-item" href="about.php">About Us</a>
                                    </li>
                                    <li>
                                        <a class="menu-item" href="contact.php">Contact</a>
                                    </li>
                                    <li>
                                        <a class="menu-item" href="login.php">Login</a>
                                    </li>
                                    <li>
                                        <a class="menu-item" href="register.php">Register</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a class="menu-item" href="news-standart-right-sidebar.php">News</a>
                            </li>
                        </ul>
                    </div>
                    <div class="de-flex-col">
                        <div class="menu_side_area">
                            <?php if ($user) : ?>
                                <?php if (!empty($user_info)) : ?>
                                    <div class="de-login-menu">
                                        <span id="de-click-menu-profile" class="de-menu-profile">
                                            <?php if (!empty($user_info['avatar'])) : ?>
                                                <img src="<?php echo $user_info['avatar']; ?>" class="img-fluid" alt="">
                                            <?php else : ?>
                                                <img src="images/profile/avatar.jpeg" class="img-fluid" alt="">
                                            <?php endif; ?>
                                        </span>
                                        <div id="de-submenu-profile" class="de-submenu">
                                            <div class="d-name">
                                                <h4><?php echo $user_info['username']; ?></h4>
                                                <span class="text-gray"><?php echo $user_info['email']; ?></span>
                                            </div>

                                            <div class="d-line"></div>

                                            <ul class="menu-col">
                                                <li class="hover_list"><a href="account-dashboard.php"><i class="fa fa-home"></i> Dashboard</a></li>
                                                <li class="hover_list"><a href="account-profile.php"><i class="fa fa-user"></i> My Profile</a></li>
                                                <li class="hover_list"><a href="account-booking.php"><i class="fa fa-calendar"></i> My Orders</a></li>
                                                <li class="hover_list"><a href="account-favorite.php"><i class="fa fa-car"></i> My Favorite Cars</a></li>
                                                <li class="hover_list"><a id="signOutLink" href="logout.php"><i class="fa fa-sign-out"></i> Sign Out</a></li>
                                            </ul>
                                        </div>
                                        <span id="menu-btn"></span>
                                    </div>
                                <?php endif; ?>
                            <?php else : ?>
                                <a href="login.php" class="btn-main">Sign In</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    document.getElementById('signOutLink').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default link behavior
        if (confirm('Are you sure you want to sign out?')) {
            // Perform logout here (e.g., send a request to the server to log out)
            window.location.href = 'logout.php'; // Redirect to logout.php to log out
        }
    });
</script>