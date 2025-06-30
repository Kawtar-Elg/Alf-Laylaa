<?php
require_once __DIR__ . '/database.php';

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function getCurrentUser() {
    if (!isLoggedIn()) {
        return null;
    }
    
    return getUserById($_SESSION['user_id']);
}

function login($email, $password) {
    $user = getUserByEmail($email);
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['full_name'];
        return true;
    }
    return false;
}

function register($name, $email, $password) {
    // Check if email already exists
    $existingUser = getUserByEmail($email);
    if ($existingUser) {
        return false;
    }
    
    // Create new user using database function
    return createUser($email, $email, $password, $name);
}

function logout() {
    session_destroy();
    header('Location: index.php');
    exit;
}
?>
