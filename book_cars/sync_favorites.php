<?php
session_start();
include('config/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $favorites = $data['favorites'];
    $user_id = $_SESSION['user_id'];

    // Get current favorites from the database
    $currentFavoritesSql = "SELECT car_id FROM user_favorites WHERE user_id = $user_id";
    $result = mysqli_query($conn, $currentFavoritesSql);
    $currentFavorites = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $currentFavorites[] = $row['car_id'];
    }

    // Determine the favorites to add and remove
    $favoritesToAdd = array_diff($favorites, $currentFavorites);
    $favoritesToRemove = array_diff($currentFavorites, $favorites);

    // Remove favorites
    if (!empty($favoritesToRemove)) {
        $removeFavoritesSql = "DELETE FROM user_favorites WHERE user_id = $user_id AND car_id IN (" . implode(',', $favoritesToRemove) . ")";
        mysqli_query($conn, $removeFavoritesSql);

        // Decrement likes count for removed favorites
        $decrementLikesSql = "UPDATE cars SET likes_count = likes_count - 1 WHERE id IN (" . implode(',', $favoritesToRemove) . ")";
        mysqli_query($conn, $decrementLikesSql);
    }

    // Add new favorites
    foreach ($favoritesToAdd as $car_id) {
        $insertFavoriteSql = "INSERT INTO user_favorites (user_id, car_id) VALUES ($user_id, $car_id)";
        mysqli_query($conn, $insertFavoriteSql);

        // Increment likes count for new favorites
        $incrementLikesSql = "UPDATE cars SET likes_count = likes_count + 1 WHERE id = $car_id";
        mysqli_query($conn, $incrementLikesSql);
    }

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}

mysqli_close($conn);
