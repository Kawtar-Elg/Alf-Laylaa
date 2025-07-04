<?php
session_start();
require '../../config/database.php';

$pdo = Database::getConnection();
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $email = filter_var($data['email'], FILTER_VALIDATE_EMAIL);
    $password = $data['password'] ?? '';

    if (!$email || empty($password)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Email ou mot de passe manquant.']);
        exit();
    }

    try {
        // Regular user authentication
        $stmt = $pdo->prepare("SELECT id, full_name, password FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['full_name'];
            $_SESSION['email'] = $email;

            echo json_encode([
                'success' => true,
                'message' => 'Connexion réussie !',
                'redirect' => '../HomePage/HomePage.php'
            ]);
            exit();
        } else {
            echo json_encode(['success' => false, 'message' => 'Email ou mot de passe incorrect.']);
            exit();
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Erreur serveur.']);
        exit();
    }
} else {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Aucune donnée reçue.']);
    exit();
}
