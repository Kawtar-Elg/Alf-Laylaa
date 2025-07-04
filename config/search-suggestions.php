<?php
require_once 'database.php';
header('Content-Type: application/json');

$search = $_GET['q'] ?? '';
if (strlen($search) < 1) {
    echo json_encode([]);
    exit;
}

$pdo = Database::getConnection();


try {
    $stmt = $pdo->prepare("SELECT DISTINCT name FROM hotels WHERE name LIKE :term LIMIT 5");
    $stmt->execute([':term' => '%' . $search . '%']);
    $hotelNames = $stmt->fetchAll(PDO::FETCH_COLUMN);
} catch (Throwable $e) {
    echo json_encode([
        'error' =>
            [
                'message' =>
                    'Database error: ' . $e->
                        getMessage()
            ]
    ]);
    exit;
}
$cityNames = [];

try {
    $stmt2 = $pdo->prepare("SELECT DISTINCT name FROM cities WHERE name LIKE :term LIMIT 5");
    $stmt2->execute([':term' => '%' . $search . '%']);
    $cityNames = $stmt2->fetchAll(PDO::FETCH_COLUMN);
} catch (Throwable $e) {
    echo json_encode([
        'error' =>
            [
                'message' =>
                    'Database error: ' . $e->
                        getMessage()
            ]
    ]);
    exit;
}

$suggestions = array_unique(array_merge($hotelNames, $cityNames));
echo json_encode(array_values($suggestions));
