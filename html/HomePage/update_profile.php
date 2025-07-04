<?php
session_start();
require_once '../../config/auth.php';
require_once '../../config/database.php';

// Check if user is logged in
if (!isLoggedIn()) {
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Not authenticated']);
        exit;
    }
    header('Location: login.php');
    exit;
}

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $user = getCurrentUser();
        $db = Database::getConnection();
        
        // Handle different types of updates
        $action = $_POST['action'] ?? 'update_profile';
        
        switch ($action) {
            case 'upload_image':
                $response = handleImageUpload($user, $db);
                break;
                
            case 'update_field':
                $response = handleFieldUpdate($user, $db);
                break;
                
            default:
                $response = handleFullProfileUpdate($user, $db);
                break;
        }
        
    } catch (Exception $e) {
        $response['message'] = 'Error: ' . $e->getMessage();
        error_log("Profile update error: " . $e->getMessage());
    }
} else {
    $response['message'] = 'Invalid request method';
}

// Return JSON response for AJAX requests
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

// For regular form submissions, redirect back to dashboard
if ($response['success']) {
    $_SESSION['profile_message'] = $response['message'];
    $_SESSION['profile_message_type'] = 'success';
} else {
    $_SESSION['profile_message'] = $response['message'];
    $_SESSION['profile_message_type'] = 'error';
}

header('Location: dashboard.php#profile');
exit;

// Function to handle full profile update
function handleFullProfileUpdate($user, $db) {
    $response = ['success' => false, 'message' => ''];
    
    // Get form data
    $username = trim($_POST['username'] ?? $user['username']);
    $email = trim($_POST['email'] ?? $user['email']);
    $full_name = trim($_POST['full_name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $date_of_birth = $_POST['date_of_birth'] ?? null;
    $address = trim($_POST['address'] ?? '');
    
    // Validate required fields
    if (empty($full_name)) {
        throw new Exception('Full name is required');
    }
    
    if (empty($email)) {
        throw new Exception('Email is required');
    }
    
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Please enter a valid email address');
    }
    
    // Check if email is already taken by another user
    if ($email !== $user['email']) {
        $stmt = $db->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
        $stmt->execute([$email, $user['id']]);
        if ($stmt->fetch()) {
            throw new Exception('Email address is already taken');
        }
    }
    
    // Check if username is already taken by another user
    if ($username !== $user['username']) {
        $stmt = $db->prepare("SELECT id FROM users WHERE username = ? AND id != ?");
        $stmt->execute([$username, $user['id']]);
        if ($stmt->fetch()) {
            throw new Exception('Username is already taken');
        }
    }
    
    // Validate date of birth
    if ($date_of_birth && !empty($date_of_birth)) {
        $dob = DateTime::createFromFormat('Y-m-d', $date_of_birth);
        if (!$dob || $dob->format('Y-m-d') !== $date_of_birth) {
            throw new Exception('Please enter a valid date of birth');
        }
        
        // Check if user is at least 13 years old
        $today = new DateTime();
        $age = $today->diff($dob)->y;
        if ($age < 13) {
            throw new Exception('You must be at least 13 years old');
        }
    }
    
    // Handle profile image upload if provided
    $profile_image = $user['profile_image']; // Keep existing image by default
    
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $imageResult = uploadProfileImage($_FILES['profile_image'], $user['id']);
        if ($imageResult['success']) {
            $profile_image = $imageResult['image_path'];
        } else {
            throw new Exception($imageResult['message']);
        }
    }
    
    // Update user data
    $stmt = $db->prepare("
        UPDATE users 
        SET username = ?, email = ?, full_name = ?, phone = ?, 
            date_of_birth = ?, address = ?, profile_image = ?, updated_at = NOW()
        WHERE id = ?
    ");
    
    $result = $stmt->execute([
        $username, $email, $full_name, $phone, 
        $date_of_birth, $address, $profile_image, $user['id']
    ]);
    
    if ($result) {
        $response['success'] = true;
        $response['message'] = 'Profile updated successfully!';
        
        // Update session data if email changed
        if ($email !== $user['email']) {
            $_SESSION['user_email'] = $email;
        }
    } else {
        $response['message'] = 'Failed to update profile. Please try again.';
    }
    
    return $response;
}

// Function to handle image upload
function handleImageUpload($user, $db) {
    $response = ['success' => false, 'message' => ''];
    
    if (!isset($_FILES['profile_image']) || $_FILES['profile_image']['error'] !== UPLOAD_ERR_OK) {
        $response['message'] = 'No image file provided or upload error';
        return $response;
    }
    
    $imageResult = uploadProfileImage($_FILES['profile_image'], $user['id']);
    
    if ($imageResult['success']) {
        // Update database with new image path
        $stmt = $db->prepare("UPDATE users SET profile_image = ?, updated_at = NOW() WHERE id = ?");
        $result = $stmt->execute([$imageResult['image_path'], $user['id']]);
        
        if ($result) {
            $response['success'] = true;
            $response['message'] = 'Profile image updated successfully!';
            $response['image_url'] = $imageResult['image_path'];
        } else {
            $response['message'] = 'Failed to update image in database';
        }
    } else {
        $response['message'] = $imageResult['message'];
    }
    
    return $response;
}

// Function to handle single field update
function handleFieldUpdate($user, $db) {
    $response = ['success' => false, 'message' => ''];
    
    // Get the field name and value
    $allowedFields = ['full_name', 'phone', 'address', 'date_of_birth'];
    $fieldName = '';
    $fieldValue = '';
    
    foreach ($allowedFields as $field) {
        if (isset($_POST[$field])) {
            $fieldName = $field;
            $fieldValue = trim($_POST[$field]);
            break;
        }
    }
    
    if (empty($fieldName)) {
        $response['message'] = 'No valid field provided for update';
        return $response;
    }
    
    // Validate the field value
    if ($fieldName === 'full_name' && empty($fieldValue)) {
        $response['message'] = 'Full name cannot be empty';
        return $response;
    }
    
    if ($fieldName === 'date_of_birth' && !empty($fieldValue)) {
        $dob = DateTime::createFromFormat('Y-m-d', $fieldValue);
        if (!$dob || $dob->format('Y-m-d') !== $fieldValue) {
            $response['message'] = 'Please enter a valid date of birth';
            return $response;
        }
    }
    
    // Update the specific field
    $stmt = $db->prepare("UPDATE users SET {$fieldName} = ?, updated_at = NOW() WHERE id = ?");
    $result = $stmt->execute([$fieldValue, $user['id']]);
    
    if ($result) {
        $response['success'] = true;
        $response['message'] = ucfirst(str_replace('_', ' ', $fieldName)) . ' updated successfully!';
    } else {
        $response['message'] = 'Failed to update ' . str_replace('_', ' ', $fieldName);
    }
    
    return $response;
}

// Function to upload and validate profile image
function uploadProfileImage($file, $userId) {
    $response = ['success' => false, 'message' => '', 'image_path' => ''];
    
    // Validate file type
    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
    if (!in_array($file['type'], $allowedTypes)) {
        $response['message'] = 'Invalid file type. Please upload a JPEG, PNG, or GIF image.';
        return $response;
    }
    
    // Validate file size (max 5MB)
    $maxSize = 5 * 1024 * 1024; // 5MB in bytes
    if ($file['size'] > $maxSize) {
        $response['message'] = 'File size too large. Please upload an image smaller than 5MB.';
        return $response;
    }
    
    // Create upload directory if it doesn't exist
    $uploadDir = '../../uploads/profiles/';
    if (!is_dir($uploadDir)) {
        if (!mkdir($uploadDir, 0755, true)) {
            $response['message'] = 'Failed to create upload directory.';
            return $response;
        }
    }
    
    // Generate unique filename
    $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $fileName = 'profile_' . $userId . '_' . time() . '.' . $fileExtension;
    $uploadPath = $uploadDir . $fileName;
    $relativePath = 'uploads/profiles/' . $fileName;
    
    // Move uploaded file
    if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
        // Validate that it's actually an image
        $imageInfo = getimagesize($uploadPath);
        if ($imageInfo === false) {
            unlink($uploadPath); // Delete the file
            $response['message'] = 'Invalid image file.';
            return $response;
        }
        
        // Resize image if it's too large
        if ($imageInfo[0] > 800 || $imageInfo[1] > 800) {
            $resizeResult = resizeImage($uploadPath, $uploadPath, 800, 800);
            if (!$resizeResult) {
                $response['message'] = 'Failed to resize image.';
                return $response;
            }
        }
        
        $response['success'] = true;
        $response['message'] = 'Image uploaded successfully!';
        $response['image_path'] = $relativePath;
    } else {
        $response['message'] = 'Failed to upload image.';
    }
    
    return $response;
}

// Function to resize image
function resizeImage($source, $destination, $maxWidth, $maxHeight) {
    $imageInfo = getimagesize($source);
    if ($imageInfo === false) return false;
    
    $width = $imageInfo[0];
    $height = $imageInfo[1];
    $type = $imageInfo[2];
    
    // Calculate new dimensions
    $ratio = min($maxWidth / $width, $maxHeight / $height);
    $newWidth = round($width * $ratio);
    $newHeight = round($height * $ratio);
    
    // Create image resource based on type
    switch ($type) {
        case IMAGETYPE_JPEG:
            $sourceImage = imagecreatefromjpeg($source);
            break;
        case IMAGETYPE_PNG:
            $sourceImage = imagecreatefrompng($source);
            break;
        case IMAGETYPE_GIF:
            $sourceImage = imagecreatefromgif($source);
            break;
        default:
            return false;
    }
    
    if (!$sourceImage) return false;
    
    // Create new image
    $newImage = imagecreatetruecolor($newWidth, $newHeight);
    
    // Preserve transparency for PNG and GIF
    if ($type == IMAGETYPE_PNG || $type == IMAGETYPE_GIF) {
        imagealphablending($newImage, false);
        imagesavealpha($newImage, true);
        $transparent = imagecolorallocatealpha($newImage, 255, 255, 255, 127);
        imagefilledrectangle($newImage, 0, 0, $newWidth, $newHeight, $transparent);
    }
    
    // Resize image
    imagecopyresampled($newImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
    
    // Save image based on type
    $result = false;
    switch ($type) {
        case IMAGETYPE_JPEG:
            $result = imagejpeg($newImage, $destination, 90);
            break;
        case IMAGETYPE_PNG:
            $result = imagepng($newImage, $destination);
            break;
        case IMAGETYPE_GIF:
            $result = imagegif($newImage, $destination);
            break;
    }
    
    // Clean up
    imagedestroy($sourceImage);
    imagedestroy($newImage);
    
    return $result;
}
?>