

<?php
include('config/config.php');

function getFilteredCars($filters, $conn)
{
    $sql = "SELECT 
            c.id,
            c.name,
            c.body,
            c.seat,
            c.door,
            c.luggage,
            cd.total_price,
            ci.front_image,
            c.likes_count
        FROM 
            cars c
        JOIN 
            cars_details cd ON c.id = cd.car_id
        JOIN 
            cars_image ci ON c.id = ci.car_id
        WHERE 1=1";

    if (!empty($filters['vehicle_type'])) {
        $vehicle_types = implode("','", array_map('addslashes', $filters['vehicle_type']));
        $sql .= " AND c.vehicle_type IN ('$vehicle_types')";
    }

    // The rest of the conditions remain the same...


    if (!empty($filters['car_body_type'])) {
        $body_types = implode("','", array_map('addslashes', $filters['car_body_type']));
        $sql .= " AND c.body IN ('$body_types')";
    }

    if (!empty($filters['car_seat'])) {
        $car_seats = implode("','", array_map('addslashes', $filters['car_seat']));
        $sql .= " AND c.seat IN ('$car_seats')";
    }

    if (!empty($filters['car_engine'])) {
        $car_engines = implode("','", array_map('addslashes', $filters['car_engine']));
        $sql .= " AND cd.engine_capacity IN ('$car_engines')";
    }

    if (!empty($filters['price_min'])) {
        $sql .= " AND cd.total_price >= " . intval($filters['price_min']);
    }

    if (!empty($filters['price_max'])) {
        $sql .= " AND cd.total_price <= " . intval($filters['price_max']);
    }

    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $filters = [
        'vehicle_type' => $_POST['vehicle_type'] ?? [],
        'car_body_type' => $_POST['car_body_type'] ?? [],
        'car_seat' => $_POST['car_seat'] ?? [],
        'car_engine' => $_POST['car_engine'] ?? [],
        'price_min' => $_POST['price_min'] ?? 0,
        'price_max' => $_POST['price_max'] ?? 2000
    ];

    $cars = getFilteredCars($filters, $conn);
    echo json_encode($cars);
}
?>
