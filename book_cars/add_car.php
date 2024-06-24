<?php

include('config/config.php');

// SQL query to fetch car details
$sql_brand = "SELECT 
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
            cars_details cd ON c.id = cd.car_id";

$query_brand = mysqli_query($conn, $sql_brand);

if (isset($_POST['sbm'])) {
    $name = $_POST['name'];
    $body = $_POST['body'];
    $seat = $_POST['seat'];
    $door = $_POST['door'];
    $luggage = $_POST['luggage'];
    $horsepower = $_POST['horsepower'];
    $likes_count = $_POST['likes_count'];
    $front_image = "images/cars/" . $_FILES['front_image']['name'];
    $rear_image = "images/cars/" . $_FILES['rear_image']['name'];
    $right_image = "images/cars/" . $_FILES['right_image']['name'];
    $left_image = "images/cars/" . $_FILES['left_image']['name'];
    $front_image_tmp = $_FILES['front_image']['tmp_name'];
    $rear_image_tmp = $_FILES['rear_image']['tmp_name'];
    $right_image_tmp = $_FILES['right_image']['tmp_name'];
    $left_image_tmp = $_FILES['left_image']['tmp_name'];
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



    $sql1 = "INSERT INTO cars (name, body, seat, door, luggage, horsepower, likes_count) VALUES ('$name', '$body', '$seat', '$door', '$luggage', '$horsepower', '$likes_count')";
    $query1 = mysqli_query($conn, $sql1);

    // Lấy id của bản ghi mới được thêm vào
    $car_id = mysqli_insert_id($conn);

    $sql2 = "INSERT INTO cars_image (car_id, front_image, rear_image, right_image, left_image) VALUES ('$car_id', '$front_image', '$rear_image', '$right_image', '$left_image')";
    $query2 = mysqli_query($conn, $sql2);

    $sql3 = "INSERT INTO cars_details (car_id, description, fuel_type, engine_capacity, year, mileage, transmission, drive, fuel_economy, exterior_color, interior_color, total_price) VALUES ('$car_id', '$description', '$fuel_type', '$engine_capacity', '$year', '$mileage', '$transmission', '$drive', '$fuel_economy', '$exterior_color', '$interior_color', '$total_price')";
    $query3 = mysqli_query($conn, $sql3);
    move_uploaded_file($front_image_tmp, $front_image);
    move_uploaded_file($rear_image_tmp, $rear_image);
    move_uploaded_file($right_image_tmp, $right_image);
    move_uploaded_file($left_image_tmp, $left_image);
    header('Location: admin.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <title>Document</title>
</head>

<body>
    <h5 class="text-center" style="padding-top: 50px;">
        <strong>Enter More Information About The Car You Want To Rent Here</strong>
    </h5>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="border-3 border border-white rounded shadow p-3" style="border-radius: 30px">
                    <form method="post" enctype="multipart/form-data">
                        <!-- Your form fields go here -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name Car</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name Cars" required />
                        </div>
                        <div class="mb-3">
                            <label for="body" class="form-label">Body Car</label>
                            <input type="text" class="form-control" id="body" name="body" placeholder="Enter Body Cars" required />
                        </div>
                        <div class="mb-3">
                            <label for="seat" class="form-label">Seat</label>
                            <input type="number" class="form-control" id="seat" name="seat" placeholder="Enter Seat" required />
                        </div>
                        <div class="mb-3">
                            <label for="door" class="form-label">Door</label>
                            <input type="number" class="form-control" id="door" name="door" placeholder="Enter Door" required />
                        </div>
                        <div class="mb-3">
                            <label for="luggage" class="form-label">Luggage</label>
                            <input type="number" class="form-control" id="luggage" name="luggage" placeholder="Enter Luggage" required />
                        </div>
                        <div class="mb-3">
                            <label for="horsepower" class="form-label">Horsepower</label>
                            <input type="number" class="form-control" id="horsepower" name="horsepower" placeholder="Enter Horsepower" required />
                        </div>
                        <div class="mb-3">
                            <label for="door" class="form-label">Likes Count</label>
                            <input type="number" class="form-control" id="likes_count" name="likes_count" placeholder="Enter Likes Co" required />
                        </div>
                        <div class="mb-3">
                            <label for="image1" class="form-label">Front Image</label>
                            <input type="file" class="form-control" id="front_image" name="front_image" required />
                        </div>
                        <div class="mb-3">
                            <label for="image2" class="form-label">Rear Image</label>
                            <input type="file" class="form-control" id="rear_image" name="rear_image" required />
                        </div>
                        <div class="mb-3">
                            <label for="image3" class="form-label">Right Image</label>
                            <input type="file" class="form-control" id="right_image" name="right_image" required />
                        </div>
                        <div class="mb-3">
                            <label for="image4" class="form-label">Left Image</label>
                            <input type="file" class="form-control" id="left_image" name="left_image" required />
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Description</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="Enter Description" required />
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Fuel Type</label>
                            <input type="text" class="form-control" id="fuel_type" name="fuel_type" placeholder="Enter Fuel Type" required />
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">engine_capacity</label>
                            <input type="text" class="form-control" id="engine_capacity" name="engine_capacity" placeholder="Enter engine_capacity" required />
                        </div>
                        <div class="mb-3">
                            <label for="door" class="form-label">Year</label>
                            <input type="number" class="form-control" id="year" name="year" placeholder="Enter Year" required />
                        </div>
                        <div class="mb-3">
                            <label for="door" class="form-label">Mileage</label>
                            <input type="number" class="form-control" id="mileage" name="mileage" placeholder="Enter Mileage" required />
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Transmission</label>
                            <input type="text" class="form-control" id="transmission" name="transmission" placeholder="Enter Transmission" required />
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Drive</label>
                            <input type="text" class="form-control" id="drive" name="drive" placeholder="Enter Drive" required />
                        </div>
                        <div class="mb-3">
                            <label for="door" class="form-label">Fuel Economy</label>
                            <input type="number" class="form-control" id="fuel_economy" name="fuel_economy" placeholder="Enter Fuel Economy" required />
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Exterior Color</label>
                            <input type="text" class="form-control" id="exterior_color" name="exterior_color" placeholder="Enter Exterrior Color" required />
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Interior Color</label>
                            <input type="text" class="form-control" id="interior_color" name="interior_color" placeholder="Enter Interior Color" required />
                        </div>
                        <div class="mb-3">
                            <label for="door" class="form-label">Total Price</label>
                            <input type="number" class="form-control" id="total_price" name="total_price" placeholder="Enter Total Price" required />
                        </div>
                        <button onclick="return addCar();" name="sbm" type="submit" class="btn btn-primary">Submit</button>
                        <a href="admin.php" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<!-- <script>
        function addCar () {
            return confirm('Are you sure you want to add this car?');
        }
    </script> -->

</html>