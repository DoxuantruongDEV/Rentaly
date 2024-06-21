<?php
include('config/config.php');

// SQL query to fetch car details
$sql = "SELECT 
            c.id,
            c.name,
            c.body,
            c.seat,
            c.door,
            c.luggage,
            c.horsepower,
            c.likes_count,
            ci.front_image,
            ci.rear_image,
            ci.right_image,
            ci.left_image,
            cd.description,
            cd.fuel_type,
            cd.engine_capacity,
            cd.year,
            cd.mileage,
            cd.transmission,
            cd.drive,
            cd.fuel_economy,
            cd.exterior_color,
            cd.interior_color,
            cd.total_price
            
        FROM 
            cars c
        JOIN 
            cars_details cd ON c.id = cd.car_id
        JOIN 
            cars_image ci ON c.id = ci.car_id";

$result = mysqli_query($conn, $sql);

function formatPrice($price)
{
  // Check if the price has a decimal part and remove it if it's ".00"
  return (strpos($price, '.00') !== false) ? rtrim(rtrim($price, '0'), '.') : $price;
}

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
?>
    <div>
      <tbody class="list">
        <tr>
          <td class="goal-project">
            <?php echo $row['name'] ?>
          </td>
          <td class="goal-project">
            <?php echo $row['body'] ?>
          </td>
          <td class="goal-project">
            <?php echo  $row['year'] ?>
          </td>
          <td class="goal-project">
            <?php echo $row['exterior_color'] ?>
          </td>
          <td class="goal-project">
            <?php echo $row['horsepower'] ?> Hp
          </td>
          <td class="goal-project">
            $ <?php echo formatPrice($row['total_price']) ?>
          </td>
          <td class="text-end">
            <div class="avatar-group">
              <a href="show_car.php?id=<?php echo $row['id'] ?>" class="avatar avatar-xs" data-bs-toggle="tooltip" title="<?php echo $row['name'] ?>">
                <img src=<?php echo $row['front_image'] ?> class="avatar-img rounded-circle" alt="...">
              </a>
            </div>
          </td>
          <td class="text-end">
            <div class="dropdown">
              <a href="#" class="dropdown-ellipses dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fe fe-more-vertical"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-end">
                <a href="update_car.php?id=<?php echo $row['id'] ?>" class="dropdown-item">
                  Edit
                </a>
                <a onclick="return deleteCar('<?php echo $row['name']; ?>')" href="delete_car.php?id=<?php echo $row['id']; ?>" class="dropdown-item">
                  Delete
                </a>
              </div>
            </div>
          </td>
        </tr>
        <script>
          function deleteCar(name) {
            return confirm("Are you sure you want to delete vehicle information for " + name + "?");
          }
        </script>
      </tbody>
  <?php
  }
} else {
  echo "No cars found";
}

mysqli_close($conn);
  ?>