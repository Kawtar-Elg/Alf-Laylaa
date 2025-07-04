<?php
require_once 'database.php';

header('Content-Type: application/json');

$search = $_GET['search'] ?? '';

try {
    $hotels = getHotelsBySearch($search);

    error_log('Hotels result: ' . print_r($hotels, true));

    echo json_encode($hotels);
} catch (Throwable $e) {
    http_response_code(500);

    error_log('Error: ' . $e->getMessage());

    echo json_encode(['error' => 'Server error: ' . $e->getMessage()]);
}
