<?php
require_once 'config/config.php'; // Kết nối cơ sở dữ liệu

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Lấy user_id từ session
$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Không có dữ liệu!";
    exit; // Thoát khỏi trang nếu không tìm thấy user
}
// Kiểm tra xem người dùng đã chọn ảnh mới chưa
if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
    // Thư mục lưu trữ ảnh tải lên
    $uploadDir = 'images/profile/';

    // Tạo đường dẫn mới cho tệp ảnh
    $uploadFile = $uploadDir . basename($_FILES['avatar']['name']);

    // Di chuyển tệp ảnh vào thư mục lưu trữ
    if (move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile)) {
        // Lưu đường dẫn của ảnh vào cơ sở dữ liệu
        $avatarUrl = $uploadFile;

        // Cập nhật đường dẫn ảnh mới vào cơ sở dữ liệu
        $updateAvatarSQL = "UPDATE users SET avatar=? WHERE id=?";
        $stmt = $conn->prepare($updateAvatarSQL);
        $stmt->bind_param("si", $avatarUrl, $user_id);
        $stmt->execute();

        // Đóng kết nối
        $stmt->close();

        // Cập nhật đường dẫn ảnh trong dữ liệu hiển thị người dùng
        $row['avatar'] = $avatarUrl;

        // Hiển thị thông báo thành công
        echo '<div class="toast success">';
        echo '<i class="fas fa-check-circle"></i>';
        echo '<span class="msg">Ảnh đã được cập nhật thành công!</span>';
        echo '</div>';
    } else {
        // Hiển thị thông báo lỗi nếu không thể di chuyển tệp ảnh
        echo '<div class="toast error">';
        echo '<i class="fas fa-exclamation-triangle"></i>';
        echo '<span class="msg">Đã xảy ra lỗi khi tải lên ảnh!</span>';
        echo '</div>';
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $new_password = $_POST['new_password'] ?? ''; // Mật khẩu mới
    $rs_password = $_POST['rs_password'] ?? ''; // Xác nhận mật khẩu
    $language = $_POST['language'] ?? '';
    $hour = $_POST['hour'] ?? '';

    if (!empty($new_password) && $new_password === $rs_password) {
        // Nếu người dùng đã nhập mật khẩu mới và xác nhận mật khẩu đúng
        $update_sql = "UPDATE users SET username=?, phone=?, password=?, language=?, hour=? WHERE id=?";
        // Sử dụng mật khẩu người dùng trực tiếp trong câu lệnh SQL, không băm mật khẩu
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("sssssi", $username, $phone, $new_password, $language, $hour, $user_id);
    } else {
        // Nếu không có mật khẩu mới hoặc xác nhận mật khẩu không khớp
        $update_sql = "UPDATE users SET username=?, phone=?, language=?, hour=? WHERE id=?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("ssssi", $username, $phone, $language, $hour, $user_id);
    }

    if ($stmt->execute()) {
        echo '<div class="toast success">';
        echo '<i class="fas fa-check-circle"></i>';
        echo '<span class="msg">Thông tin đã được cập nhật thành công!</span>';
        echo '</div>';
    } else {
        echo "Lỗi khi thực thi câu lệnh.";
    }
}

// Đóng kết nối
$conn->close();

?>
<form id="form-create-item" class="form-border" method="post" action="#" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-3 mb30">
            <div class="card padding30 rounded-5">
                <div class="profile_avatar">
                    <div class="profile_img">
                        <label for="avatarInput">
                            <img id="avatar" src="<?php echo empty($row['avatar']) ? 'images/profile/avatar.jpeg' : $row['avatar']; ?>" class="img-fluid" alt="Avatar">
                        </label>
                        <input type="file" name="avatar" id="avatarInput" class="form-control" accept="image/*" style="display: none;">
                    </div>
                    <div class="profile_name">
                        <h4>
                            <?php echo $row['name']; ?>
                            <span class="profile_username text-gray"><?php echo $row['email']; ?></span>
                        </h4>
                    </div>
                </div>
                <div class="spacer-20"></div>
                <ul class="menu-col">
                    <li><a href="account-dashboard.php"><i class="fa fa-home"></i>Dashboard</a></li>
                    <li><a href="account-profile.php"><i class="fa fa-user"></i>My Profile</a></li>
                    <li><a href="account-booking.php"><i class="fa fa-calendar"></i>My Orders</a></li>
                    <li><a href="account-favorite.php"><i class="fa fa-car"></i>My Favorite Cars</a></li>
                    <li><a href="logout.php"><i class="fa fa-sign-out"></i>Sign Out</a></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="card padding40 rounded-5">
                <div class="row">
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
                                            <h5>Phone</h5>
                                            <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter phone" value="<?php echo htmlspecialchars($row['phone'] ?? ''); ?>" required />
                                        </div>
                                        <div class="col-lg-6 mb20">
                                            <h5>New Password</h5>
                                            <input type="password" name="new_password" id="new_password" class="form-control" placeholder="********" />
                                        </div>
                                        <div class="col-lg-6 mb20">
                                            <h5>Re-enter Password</h5>
                                            <input type="password" name="rs_password" id="rs_password" class="form-control" placeholder="********" />
                                        </div>
                                        <div class="col-md-6 mb20">
                                            <h5>Language</h5>
                                            <p class="p-info">Select your preferred language.</p>
                                            <div id="select_lang" class="dropdown fullwidth">
                                                <select name="language" id="language" class="form-control" required>
                                                    <option value="English" <?php echo ($row['language'] == 'English') ? 'selected' : ''; ?>>English</option>
                                                    <option value="Vietnamese" <?php echo ($row['language'] == 'Vietnamese') ? 'selected' : ''; ?>>Vietnamese</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb20">
                                            <h5>Hour</h5>
                                            <p class="p-info">Select your preferred hour.</p>
                                            <div id="select_hour_format" class="dropdown fullwidth">
                                                <select name="hour" id="hour" class="form-control" required>
                                                    <option value="24-hour" <?php echo ($row['hour'] == '24-hour') ? 'selected' : ''; ?>>24-hour</option>
                                                    <option value="12-hour" <?php echo ($row['hour'] == '12-hour') ? 'selected' : ''; ?>>12-hour</option>
                                                </select>
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
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    document.getElementById('avatarInput').addEventListener('change', function() {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatar').src = e.target.result; // Hiển thị ảnh được chọn trong thẻ <img> có id 'avatar'
                var newAvatarUrl = e.target.result;
            };
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>