<?php
require_once 'database.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$hotelId = isset($_GET['hotel_id']) ? (int) $_GET['hotel_id'] : 0;

if ($hotelId <= 0) {
    echo json_encode(['success' => false, 'error' => 'Invalid hotel ID']);
    exit;
}

try {
    $pdo = Database::getConnection();

    $stmt = $pdo->prepare("
        SELECT id, name, price, capacity, type, size, images, 4.9 as rating
        FROM rooms 
        WHERE hotel_id = :hotel_id AND is_available = 1
        ORDER BY id DESC
        LIMIT 6
    ");
    $stmt->bindParam(':hotel_id', $hotelId, PDO::PARAM_INT);
    $stmt->execute();

    $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'success' => true,
        'rooms' => $rooms
    ]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
