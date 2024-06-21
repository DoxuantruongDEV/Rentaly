<?php
session_start();
include("config/config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $car_id = $data['car_id'];
    $user_id = $_SESSION['user_id'];

    if ($car_id && $user_id) {
        $removeFavoriteSql = "DELETE FROM user_favorites WHERE user_id = ? AND car_id = ?";
        $stmt = $conn->prepare($removeFavoriteSql);
        $stmt->bind_param("ii", $user_id, $car_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to remove favorite']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid data']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}

mysqli_close($conn);
