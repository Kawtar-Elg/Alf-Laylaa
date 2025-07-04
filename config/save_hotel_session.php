<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hotel_id']) && isset($_POST['hotel_name'])) {
    $_SESSION['selectedHotelId'] = (int) $_POST['hotel_id'];
    $_SESSION['selectedHotelName'] = trim($_POST['hotel_name']);
    echo json_encode(['success' => true]);
    exit;
}

echo json_encode(['success' => false]);
?>
