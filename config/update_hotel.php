<?php
require_once 'database.php';
$pdo = Database::getConnection();

$id = $_POST['id'];
$name = $_POST['name'];
$address = $_POST['address'];
$description = $_POST['description'];
$available_rooms = $_POST['available_rooms'];

$stmt = $pdo->prepare("UPDATE hotels SET name=?, address=?, description=?, available_rooms=? WHERE id=?");
$success = $stmt->execute([$name, $address, $description, $available_rooms, $id]);

echo json_encode(['success' => $success]);
