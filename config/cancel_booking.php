<?php
session_start();

require_once 'database.php'; 

$pdo = Database::getConnection();

if (isset($_GET['id'])) {
    $booking_id = intval($_GET['id']);

    $stmt = $pdo->prepare("UPDATE bookings SET status = 'cancelled' WHERE id = ?");
    $stmt->execute([$booking_id]);
}

header("Location: " . $_SERVER['HTTP_REFERER']);
exit;