<?php
include("config/config.php");
include('format_date.php');

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT bookings.booking_id, cars.name AS car_name, bookings.pick_up_location, bookings.destination, bookings.pick_up_date, bookings.return_date, bookings.status 
            FROM bookings 
            INNER JOIN cars ON bookings.car_id = cars.id 
            WHERE bookings.user_id = ? AND bookings.status = 'scheduled';";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
?>
                <tr>
                    <td><span class="d-lg-none d-sm-block">Order ID</span>
                        <div class="badge bg-gray-100 text-dark">#<?php echo $row['booking_id']; ?></div>
                    </td>
                    <td><span class="d-lg-none d-sm-block">Car Name</span><span class="bold"><?php echo $row['car_name']; ?></span></td>
                    <td><span class="d-lg-none d-sm-block">Pick Up Location</span><?php echo $row['pick_up_location']; ?></td>
                    <td><span class="d-lg-none d-sm-block">Drop Off Location</span><?php echo $row['destination']; ?></td>
                    <td><span class="d-lg-none d-sm-block">Pick Up Date</span><?php echo formatDate($row['pick_up_date']); ?></td>
                    <td><span class="d-lg-none d-sm-block">Return Date</span><?php echo formatDate($row['return_date']); ?></td>
                    <td>
                        <div class="badge rounded-pill status-badge" data-status="<?php echo $row['status']; ?>"><?php echo $row['status']; ?></div>
                    </td>
                </tr>
<?php
            }
        } else {
            echo '<tr><td colspan="7" style="text-align:center; padding:20px">Chưa có giao dịch</td></tr>';
        }
        $stmt->close();
    } else {
        echo "Lỗi truy vấn: " . $conn->error;
    }
} else {
    echo "Bạn chưa đăng nhập.";
}
?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var badges = document.querySelectorAll('.status-badge');
        badges.forEach(function(badge) {
            var status = badge.getAttribute('data-status');
            if (status === 'scheduled') {
                badge.classList.add('bg-warning');
            } else if (status === 'cancelled') {
                badge.classList.add('bg-danger');
            } else if (status === 'completed') {
                badge.classList.add('bg-success');
            }
        });
    });
</script>