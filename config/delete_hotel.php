<?php
require_once 'database.php';
$pdo = Database::getConnection();

$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("DELETE FROM hotels WHERE id=?");
$success = $stmt->execute([$id]);

echo json_encode(['success' => $success]);
