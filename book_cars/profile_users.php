 <?php
    include('config/config.php');
    // Kiểm tra xem người dùng đã tải lên tệp ảnh chưa
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $tempName = $_FILES['avatar']['tmp_name'];
        $fileName = $_FILES['avatar']['name'];
        // Đường dẫn tới thư mục lưu trữ ảnh trên máy chủ
        $uploadDir = 'images/profile/';
        if (move_uploaded_file($tempName, $uploadDir . $fileName)) {
            $newAvatarPath = $uploadDir . $fileName;
        } else {
            echo "Có lỗi xảy ra khi tải lên tệp ảnh.";
        }
    }
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT username, email, avatar
                            FROM users
                            WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
    ?>
             <style>
                 .profile_img img {
                     cursor: pointer;

                 }
             </style>
             <div class="col-lg-3 mb30">
                 <div class="card padding30 rounded-5">
                     <div class="profile_avatar">
                         <div class="profile_img">
                             <?php if (!empty($row['avatar'])) : ?>
                                 <label for="avatarInput">
                                     <img id="avatar" src="<?php echo $row['avatar']; ?>" class="img-fluid" alt="">
                                 </label>
                             <?php else : ?>
                                 <label for="avatarInput">
                                     <img id="avatar" src="images/profile/avatar.jpeg" class="img-fluid" alt="">
                                 </label>
                             <?php endif; ?>
                             <!-- Input type file ẩn -->
                             <input type="file" id="avatarInput" accept="image/*" style="display: none;">
                         </div>
                         <div class="profile_name">
                             <h4>
                                 <?php echo $row['username']; ?>
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

 <?php
            }
        } else {
            echo "Không tìm thấy thông tin người dùng.";
        }
    } else {
        echo "Bạn chưa đăng nhập.";
    }
    ?>
 <script>
     document.getElementById('avatarInput').addEventListener('change', function() {
         // Kiểm tra xem người dùng đã chọn tệp ảnh chưa
         if (this.files && this.files[0]) {
             var reader = new FileReader();

             // Đọc tệp ảnh và cập nhật URL của ảnh
             reader.onload = function(e) {
                 document.getElementById('avatar').src = e.target.result;

                 // Lưu trữ URL của ảnh mới vào cơ sở dữ liệu
                 var newAvatarUrl = e.target.result;
                 // Gửi newAvatarUrl đến mã PHP bằng cách sử dụng XMLHttpRequest hoặc fetch API
                 // Để cập nhật URL của ảnh trong cơ sở dữ liệu
             };

             // Đọc tệp ảnh dưới dạng URL dữ liệua
             reader.readAsDataURL(this.files[0]);
         }
     });
 </script>