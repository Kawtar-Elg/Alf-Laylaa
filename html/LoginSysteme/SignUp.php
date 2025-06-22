<?php
require '../../config/database.php';

// Récupérer les données JSON envoyées
$data = json_decode(file_get_contents('php://input'), true);

$response = ['success' => false, 'message' => ''];

if ($data) {
    $fullName = trim($data['fullName'] ?? '');
    $email = filter_var($data['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $phone = trim($data['phone'] ?? '');
    $address = trim($data['address'] ?? '');
    $password = $data['password'] ?? '';
    
    // Validation des champs
    if (empty($fullName) || empty($email) || empty($password)) {
        $response['message'] = 'Tous les champs requis doivent être remplis.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['message'] = 'Adresse e-mail invalide.';
    } elseif ($password !== ($data['confirmPassword'] ?? '')) {
        $response['message'] = 'Les mots de passe ne correspondent pas.';
    } else {
        // Vérifier si l'email existe déjà
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        
        if ($stmt->fetch()) {
            $response['message'] = 'Cet e-mail est déjà utilisé.';
        } else {
            // Hacher le mot de passe
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            // Insérer l'utilisateur dans la base
            $stmt = $pdo->prepare("
                INSERT INTO users (full_name, email, phone, address, password_hash)
                VALUES (?, ?, ?, ?, ?)
            ");
            $success = $stmt->execute([$fullName, $email, $phone, $address, $passwordHash]);

            if ($success) {
                $response['success'] = true;
                $response['message'] = 'Inscription réussie !';
            } else {
                $response['message'] = 'Erreur lors de l\'inscription.';
            }
        }
    }
} else {
    $response['message'] = 'Aucune donnée reçue.';
}

// Réponse en JSON
header('Content-Type: application/json');
echo json_encode($response);
?>