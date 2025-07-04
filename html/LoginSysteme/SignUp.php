<?php
require '../../config/database.php';

$pdo = Database::getConnection();

$data = json_decode(file_get_contents('php://input'), true);

$response = ['success' => false, 'message' => ''];

if ($data) {
    $fullName = trim($data['fullName'] ?? '');
    $email = filter_var($data['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $phone = trim($data['phone'] ?? '');
    $address = trim($data['address'] ?? '');
    $password = $data['password'] ?? '';
    $confirmPassword = $data['confirmPassword'] ?? '';
    $dateOfBirth = trim($data['dateOfBirth'] ?? null);
    $username = explode('@', $email)[0];
    $profileImage = null;
    $emailVerified = false;
    $status = 'active';

    if (empty($fullName) || empty($email) || empty($password)) {
        $response['message'] = 'Tous les champs requis doivent être remplis.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['message'] = 'Adresse e-mail invalide.';
    } elseif ($password !== ($data['confirmPassword'] ?? '')) {
        $response['message'] = 'Les mots de passe ne correspondent pas.';
    } else {

        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->fetch()) {
            $response['message'] = 'Cet e-mail est déjà utilisé.';
        } else {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("
                INSERT INTO users (username, email, password, full_name, phone, address, date_of_birth, profile_image, email_verified, status, created_at, updated_at)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())
            ");
            $success = $stmt->execute([
                $username,
                $email,
                password_hash($password, PASSWORD_DEFAULT),
                $fullName,
                $phone,
                $address,
                $dateOfBirth,
                $profileImage,
                $emailVerified,
                $status
            ]);

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

header('Content-Type: application/json');
echo json_encode($response);
?>