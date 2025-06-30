<?php
require_once 'database.php';

$pdo = Database::getConnection();

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');

$cityId = isset($_GET['city_id']) ? (int) $_GET['city_id'] : 0;

if ($cityId <= 0) {
    echo json_encode([
        'success' => false,
        'error' => 'Invalid city ID'
    ]);
    exit;
}

try {
    $stmt = $pdo->prepare("
        SELECT 
            id,
            name,
            address,
            map_link,
            description,
            is_open,
            available_rooms,
            image_url,
            created_at,
            5.0 as rating
        FROM hotels 
        WHERE city_id = :city_id 
        AND is_open = 1
        ORDER BY name ASC
    ");

    $stmt->bindParam(':city_id', $cityId, PDO::PARAM_INT);
    $stmt->execute();

    $hotels = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $response = [
        'success' => true,
        'hotels' => $hotels,
        'city_id' => $cityId,
        'total_hotels' => count($hotels)
    ];

    echo json_encode($response);

} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Query failed: ' . $e->getMessage()
    ]);
}
?>