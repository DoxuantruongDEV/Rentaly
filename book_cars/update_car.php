<?php

include('config/config.php');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid car ID provided");
}
$car_id = $_GET['id'];

// SQL query to fetch car details
$sql_car = "SELECT 
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
            cars_image ci ON c.id = ci.car_id
        JOIN 
            cars_details cd ON c.id = cd.car_id
        WHERE
            c.id = $car_id";

$query_car = mysqli_query($conn, $sql_car);
$car = mysqli_fetch_assoc($query_car);

if (isset($_POST['sbm'])) {
    $name = $_POST['name'];
    $body = $_POST['body'];
    $seat = $_POST['seat'];
    $door = $_POST['door'];
    $luggage = $_POST['luggage'];
    $horsepower = $_POST['horsepower'];
    $likes_count = $_POST['likes_count'];
    $front_image = $_FILES['front_image']['name'] ? "images/cars/" . $_FILES['front_image']['name'] : $car['front_image'];
    $rear_image = $_FILES['rear_image']['name'] ? "images/cars/" . $_FILES['rear_image']['name'] : $car['rear_image'];
    $right_image = $_FILES['right_image']['name'] ? "images/cars/" . $_FILES['right_image']['name'] : $car['right_image'];
    $left_image = $_FILES['left_image']['name'] ? "images/cars/" . $_FILES['left_image']['name'] : $car['left_image'];
    $description = $_POST['description'];
    $fuel_type = $_POST['fuel_type'];
    $engine_capacity = $_POST['engine_capacity'];
    $year = $_POST['year'];
    $mileage = $_POST['mileage'];
    $transmission = $_POST['transmission'];
    $drive = $_POST['drive'];
    $fuel_economy = $_POST['fuel_economy'];
    $exterior_color = $_POST['exterior_color'];
    $interior_color = $_POST['interior_color'];
    $total_price = $_POST['total_price'];

    if ($_FILES['front_image']['name']) {
        $front_image_tmp = $_FILES['front_image']['tmp_name'];
        move_uploaded_file($front_image_tmp, $front_image);
    }
    if ($_FILES['rear_image']['name']) {
        $rear_image_tmp = $_FILES['rear_image']['tmp_name'];
        move_uploaded_file($rear_image_tmp, $rear_image);
    }
    if ($_FILES['right_image']['name']) {
        $right_image_tmp = $_FILES['right_image']['tmp_name'];
        move_uploaded_file($right_image_tmp, $right_image);
    }
    if ($_FILES['left_image']['name']) {
        $left_image_tmp = $_FILES['left_image']['tmp_name'];
        move_uploaded_file($left_image_tmp, $left_image);
    }

    $sql1 = "UPDATE cars SET name='$name', body='$body', seat='$seat', door='$door', luggage='$luggage', horsepower='$horsepower', likes_count='$likes_count' WHERE id=$car_id";
    $query1 = mysqli_query($conn, $sql1);

    $sql2 = "UPDATE cars_image SET front_image='$front_image', rear_image='$rear_image', right_image='$right_image', left_image='$left_image' WHERE car_id=$car_id";
    $query2 = mysqli_query($conn, $sql2);

    $sql3 = "UPDATE cars_details SET description='$description', fuel_type='$fuel_type', engine_capacity='$engine_capacity', year='$year', mileage='$mileage', transmission='$transmission', drive='$drive', fuel_economy='$fuel_economy', exterior_color='$exterior_color', interior_color='$interior_color', total_price='$total_price' WHERE car_id=$car_id";
    $query3 = mysqli_query($conn, $sql3);

    if ($query1 && $query2 && $query3) {
        header('Location: admin.php');
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <title>Update Car</title>
</head>

<body>
    <h5 class="text-center" style="padding-top: 50px;">
        <strong>Update Car Information</strong>
    </h5>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="border-3 border border-white rounded shadow p-3" style="border-radius: 30px">
                    <form method="post" enctype="multipart/form-data">
                        <!-- Form fields go here, pre-filled with existing car data -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name Car</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $car['name']; ?>" required />
                        </div>
                        <div class="mb-3">
                            <label for="body" class="form-label">Body Car</label>
                            <input type="text" class="form-control" id="body" name="body" value="<?php echo $car['body']; ?>" required />
                        </div>
                        <div class="mb-3">
                            <label for="seat" class="form-label">Seat</label>
                            <input type="number" class="form-control" id="seat" name="seat" value="<?php echo $car['seat']; ?>" required />
                        </div>
                        <div class="mb-3">
                            <label for="door" class="form-label">Door</label>
                            <input type="number" class="form-control" id="door" name="door" value="<?php echo $car['door']; ?>" required />
                        </div>
                        <div class="mb-3">
                            <label for="luggage" class="form-label">Luggage</label>
                            <input type="number" class="form-control" id="luggage" name="luggage" value="<?php echo $car['luggage']; ?>" required />
                        </div>
                        <div class="mb-3">
                            <label for="horsepower" class="form-label">Horsepower</label>
                            <input type="number" class="form-control" id="horsepower" name="horsepower" value="<?php echo $car['horsepower']; ?>" required />
                        </div>
                        <div class="mb-3">
                            <label for="likes_count" class="form-label">Likes Count</label>
                            <input type="number" class="form-control" id="likes_count" name="likes_count" value="<?php echo $car['likes_count']; ?>" required />
                        </div>
                        <div class="mb-3">
                            <label for="front_image" class="form-label">Front Image</label>
                            <img src="<?php echo $car['front_image']; ?>" alt="Front Image" class="img-thumbnail mb-2" />
                            <input type="file" class="form-control" id="front_image" name="front_image" />
                        </div>
                        <div class="mb-3">
                            <label for="rear_image" class="form-label">Rear Image</label>
                            <img src="<?php echo $car['rear_image']; ?>" alt="Rear Image" class="img-thumbnail mb-2" />
                            <input type="file" class="form-control" id="rear_image" name="rear_image" />
                        </div>
                        <div class="mb-3">
                            <label for="right_image" class="form-label">Right Image</label>
                            <img src="<?php echo $car['right_image']; ?>" alt="Right Image" class="img-thumbnail mb-2" />
                            <input type="file" class="form-control" id="right_image" name="right_image" />
                        </div>
                        <div class="mb-3">
                            <label for="left_image" class="form-label">Left Image</label>
                            <img src="<?php echo $car['left_image']; ?>" alt="Left Image" class="img-thumbnail mb-2" />
                            <input type="file" class="form-control" id="left_image" name="left_image" />
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="description" name="description" value="<?php echo $car['description']; ?>" required />
                        </div>
                        <div class="mb-3">
                            <label for="fuel_type" class="form-label">Fuel Type</label>
                            <input type="text" class="form-control" id="fuel_type" name="fuel_type" value="<?php echo $car['fuel_type']; ?>" required />
                        </div>
                        <div class="mb-3">
                            <label for="engine_capacity" class="form-label">Engine Capacity</label>
                            <input type="text" class="form-control" id="engine_capacity" name="engine_capacity" value="<?php echo $car['engine_capacity']; ?>" required />
                        </div>
                        <div class="mb-3">
                            <label for="year" class="form-label">Year</label>
                            <input type="number" class="form-control" id="year" name="year" value="<?php echo $car['year']; ?>" required />
                        </div>
                        <div class="mb-3">
                            <label for="mileage" class="form-label">Mileage</label>
                            <input type="number" class="form-control" id="mileage" name="mileage" value="<?php echo $car['mileage']; ?>" required />
                        </div>
                        <div class="mb-3">
                            <label for="transmission" class="form-label">Transmission</label>
                            <input type="text" class="form-control" id="transmission" name="transmission" value="<?php echo $car['transmission']; ?>" required />
                        </div>
                        <div class="mb-3">
                            <label for="drive" class="form-label">Drive</label>
                            <input type="text" class="form-control" id="drive" name="drive" value="<?php echo $car['drive']; ?>" required />
                        </div>
                        <div class="mb-3">
                            <label for="fuel_economy" class="form-label">Fuel Economy</label>
                            <input type="number" class="form-control" id="fuel_economy" name="fuel_economy" value="<?php echo $car['fuel_economy']; ?>" required />
                        </div>
                        <div class="mb-3">
                            <label for="exterior_color" class="form-label">Exterior Color</label>
                            <input type="text" class="form-control" id="exterior_color" name="exterior_color" value="<?php echo $car['exterior_color']; ?>" required />
                        </div>
                        <div class="mb-3">
                            <label for="interior_color" class="form-label">Interior Color</label>
                            <input type="text" class="form-control" id="interior_color" name="interior_color" value="<?php echo $car['interior_color']; ?>" required />
                        </div>
                        <div class="mb-3">
                            <label for="total_price" class="form-label">Total Price</label>
                            <input type="number" class="form-control" id="total_price" name="total_price" value="<?php echo $car['total_price']; ?>" required />
                        </div>
                        <button onclick="return confirm('Are you sure you want to update this car?');" name="sbm" type="submit" class="btn btn-primary">Submit</button>
                        <a href="admin.php" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>