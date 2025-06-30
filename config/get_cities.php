<?php
require_once 'database.php';

$pdo = Database::getConnection();

$perPage = 3;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 0;
$start = $page * $perPage;

try {
    $stmt = $pdo->prepare("SELECT id, name FROM cities ORDER BY name ASC LIMIT ? OFFSET ?");
    $stmt->bindValue(1, $perPage, PDO::PARAM_INT);
    $stmt->bindValue(2, $start, PDO::PARAM_INT);
    $stmt->execute();
    $cities = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'success' => true,
        'cities' => $cities
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}

?>
