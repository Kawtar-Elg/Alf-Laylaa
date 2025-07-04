<?php
require_once 'database.php';
$pdo = Database::getConnection();

header('Content-Type: application/json');

$range = $_GET['range'] ?? 'week';

    if ($range === "week") {
        $stmt = $pdo->query("
            SELECT DAYNAME(created_at) as label, COUNT(*) as total
            FROM bookings
            WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
            GROUP BY label
        ");
    } elseif ($range === "month") {
        $stmt = $pdo->query("
            SELECT DAY(created_at) as label, COUNT(*) as total
            FROM bookings
            WHERE MONTH(created_at) = MONTH(CURDATE())
            GROUP BY label
        ");
    } elseif ($range === "year") {
        $stmt = $pdo->query("
            SELECT MONTH(created_at) as label, COUNT(*) as total
            FROM bookings
            WHERE YEAR(created_at) = YEAR(CURDATE())
            GROUP BY label
        ");
    } else {
        echo json_encode([]);
        exit;
    }

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);

