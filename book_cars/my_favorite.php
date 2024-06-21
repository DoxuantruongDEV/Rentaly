<?php
include("config/config.php");

// Function to run a query with prepared statements
function runQuery($conn, $sql, $params, $types)
{
    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    return $stmt->get_result();
}

// Function to format price
function formatPrice($price)
{
    return '$' . number_format($price, 0);
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT 
                c.id,
                c.name,
                c.body,
                c.seat,
                c.door,
                c.luggage,
                c.horsepower,
                cd.fuel_type,
                cd.engine_capacity,
                cd.drive,
                cd.total_price,
                ci.front_image
            FROM user_favorites w
            JOIN cars c ON w.car_id = c.id
            JOIN cars_details cd ON c.id = cd.car_id
            JOIN cars_image ci ON c.id = ci.car_id
            WHERE w.user_id = ?";
    $result = runQuery($conn, $sql, [$user_id], "i");

    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
?>
            <div class="de-item-list no-border mb30" id="car-<?php echo $row['id']; ?>">
                <div class="d-img">
                    <img src="<?php echo $row['front_image']; ?>" class="img-fluid" alt="">
                </div>
                <div class="d-info">
                    <div class="d-text">
                        <h4><?php echo $row['name']; ?></h4>
                        <div class="d-atr-group">
                            <ul class="d-atr">
                                <li><span>Seats:</span> <?php echo $row['seat']; ?></li>
                                <li><span>Luggage:</span> <?php echo $row['luggage']; ?></li>
                                <li><span>Doors:</span> <?php echo $row['door']; ?></li>
                                <li><span>Fuel:</span> <?php echo $row['fuel_type']; ?></li>
                                <li><span>Horsepower:</span> <?php echo $row['horsepower']; ?></li>
                                <li><span>Engine:</span> <?php echo $row['engine_capacity']; ?></li>
                                <li><span>Drive:</span> <?php echo $row['drive']; ?></li>
                                <li><span>Type:</span> <?php echo $row['body']; ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="d-price">
                    Daily rate from <span><?php echo formatPrice($row['total_price']); ?></span>
                    <a class="btn-main" href="car-single.php?cars_id=<?php echo $row['id'] ?>">Rent Now</a>
                    <div class="my-3"></div>
                    <button class="btn-main remove-favorite" data-car-id="<?php echo $row['id']; ?>">Remove</button>
                </div>
                <div class="clearfix"></div>
            </div>
<?php
        }
    } else {
        echo '<div class="alert alert-warning" role="alert">';
        echo '  Bạn chưa thêm xe nào vào danh sách yêu thích';
        echo '</div>';
    }
} else {
    echo "Bạn chưa đăng nhập.";
}
?> <script>
    document.addEventListener('DOMContentLoaded', function() {
        const removeFavoriteButtons = document.querySelectorAll('.remove-favorite');

        removeFavoriteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const carId = this.getAttribute('data-car-id');
                const carElement = document.getElementById('car-' + carId);

                fetch('remove_favorite.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            car_id: carId
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            carElement.remove();
                            alert('Car removed from favorites');
                        } else {
                            alert('Failed to remove car from favorites');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while removing the car from favorites');
                    });
            });
        });
    });
</script>