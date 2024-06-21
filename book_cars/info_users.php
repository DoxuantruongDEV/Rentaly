<?php
// Lấy user_id từ session
$user_id = $_SESSION['user_id'];
// Tạo câu truy vấn SQL sử dụng user_id
$sql = "SELECT * FROM users WHERE id = ?";
// Chuẩn bị truy vấn
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<?php while ($row = $result->fetch_assoc()) : ?>
    <div class="col-lg-12">
        <div class="de_tab tab_simple">
            <ul class="de_nav">
                <li class="active"><span>Profile</span></li>
                <li><span>Notifications</span></li>
            </ul>
            <div class="de_tab_content">
                <div class="tab-1">
                    <div class="row">
                        <div class="col-lg-6 mb20">
                            <h5>Username</h5>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter username" value="<?php echo htmlspecialchars($row['username'] ?? ''); ?>" required />
                        </div>
                        <div class="col-lg-6 mb20">
                            <h5>Email Address</h5>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter email" value="<?php echo htmlspecialchars($row['email'] ?? ''); ?>" required />
                        </div>
                        <div class="col-lg-6 mb20">
                            <h5>New Password</h5>
                            <input type="password" name="user_password" id="user_password" class="form-control" placeholder="********" />
                        </div>
                        <div class="col-lg-6 mb20">
                            <h5>Re-enter Password</h5>
                            <input type="password" name="user_password_re-enter" id="user_password_re-enter" class="form-control" placeholder="********" />
                        </div>
                        <div class="col-md-6 mb20">
                            <h5>Language</h5>
                            <p class="p-info">Select your preferred language.</p>
                            <div id="select_lang" class="dropdown fullwidth">
                                <a href="#" class="btn-selector">English</a>
                                <input type="hidden" name="language" id="language" value="<?php echo htmlspecialchars($row['language'] ?? ''); ?>" required />
                                <ul>
                                    <li class="<?php echo ($row['language'] == 'English') ? 'active' : ''; ?>"><span>English</span></li>
                                    <li class="<?php echo ($row['language'] == 'Vietnamese') ? 'active' : ''; ?>"><span>Vietnamese</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 mb20">
                            <h5>Hour</h5>
                            <p class="p-info">Select your preferred hour.</p>
                            <div id="select_hour_format" class="dropdown fullwidth">
                                <a href="#" class="btn-selector">24-hour</a>
                                <input type="hidden" name="hour" id="hour" value="<?php echo htmlspecialchars($row['hour'] ?? ''); ?>" required />
                                <ul>
                                    <li class="<?php echo ($row['hour'] == '24-hour') ? 'active' : ''; ?>"><span>24-hour</span></li>
                                    <li class="<?php echo ($row['hour'] == '12-hour') ? 'active' : ''; ?>"><span>12-hour</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- thông báo -->
                <?php include('notification.php') ?>
            </div>
        </div>
        <input type="submit" id="submit" class="btn-main" value="Update profile" style="cursor: pointer;">
    </div>
<?php endwhile; ?>