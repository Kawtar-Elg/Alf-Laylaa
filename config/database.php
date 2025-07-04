<?php

class Database
{
    private static $connection = null;

    public static function getConnection()
    {
        if (self::$connection === null) {
            try {
                $host = $_ENV['DB_HOST'] ?? 'localhost';
                $port = $_ENV['DB_PORT'] ?? '3308';
                $dbname = $_ENV['DB_NAME'] ?? 'alf_layla';
                $username = $_ENV['DB_USER'] ?? 'root';
                $password = $_ENV['DB_PASSWORD'] ?? '';

                $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
                self::$connection = new PDO($dsn, $username, $password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]);
                
            } catch (PDOException $e) {
                throw new Exception("Database connection failed: " . $e->getMessage());
            }
        }
        return self::$connection;
    }

    public static function closeConnection()
    {
        self::$connection = null;
    }
}

function getRoomsByHotelId($hotel_id = 0)
{
    $db = Database::getConnection();

    if ($hotel_id === 0) {
        $stmt = $db->prepare("SELECT * FROM rooms ORDER BY price ASC");
        $stmt->execute();
    } else {
        $stmt = $db->prepare("SELECT * FROM rooms WHERE hotel_id = ? ORDER BY price ASC");
        $stmt->bindValue(1, $hotel_id, PDO::PARAM_INT);
        $stmt->execute();
    }

    $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($rooms as &$room) {
        $room['images'] = json_decode($room['images'], true) ?? [];
        $room['amenities'] = json_decode($room['amenities'], true) ?? [];
    }

    return $rooms;
}

function getCurrentUserId()
{
    return isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
}


function getRoomById($id)
{
    $db = Database::getConnection();
    $stmt = $db->prepare("SELECT * FROM rooms WHERE id = ?");
    $stmt->execute([$id]);
    $room = $stmt->fetch();

    if ($room) {
        // Parse JSON fields
        $room['images'] = json_decode($room['images'], true) ?? [];
        $room['amenities'] = json_decode($room['amenities'], true) ?? [];

        // Add gallery field for compatibility
        $room['gallery'] = array_slice($room['images'], 1, 3);
        $room['image'] = $room['images'][0] ?? 'https://via.placeholder.com/400x300';
    }

    return $room;
}

function getRoomsByPriceRange($minPrice, $maxPrice)
{
    $db = Database::getConnection();
    $stmt = $db->prepare("SELECT * FROM rooms WHERE price >= ? AND price <= ? ORDER BY price ASC");
    $stmt->execute([$minPrice, $maxPrice]);
    $rooms = $stmt->fetchAll();

    // Parse JSON fields
    foreach ($rooms as &$room) {
        $room['images'] = json_decode($room['images'], true) ?? [];
        $room['amenities'] = json_decode($room['amenities'], true) ?? [];
    }

    return $rooms;
}

function getRoomsByType($type)
{
    $db = Database::getConnection();
    $stmt = $db->prepare("SELECT * FROM rooms WHERE type = ? ORDER BY price ASC");
    $stmt->execute([$type]);
    $rooms = $stmt->fetchAll();

    // Parse JSON fields
    foreach ($rooms as &$room) {
        $room['images'] = json_decode($room['images'], true) ?? [];
        $room['amenities'] = json_decode($room['amenities'], true) ?? [];
    }

    return $rooms;
}

// User management functions
function createUser($username, $email, $password, $fullName, $phone = null)
{
    $db = Database::getConnection();
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $db->prepare("INSERT INTO users (username, email, password, full_name, phone, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
    return $stmt->execute([$username, $email, $hashedPassword, $fullName, $phone]);
}

function getUserByEmail($email)
{
    $db = Database::getConnection();
    $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        // Add 'name' field for compatibility
        $user['name'] = $user['full_name'];
    }

    return $user;
}

function getUserById($id)
{
    $db = Database::getConnection();
    $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch();

    if ($user) {
        // Add 'name' field for compatibility
        $user['name'] = $user['full_name'];
    }

    return $user;
}

function updateUser($id, $username, $email, $fullName, $phone = null, $dateOfBirth = null, $address = null, $profileImage = null)
{
    $db = Database::getConnection();
    
    $stmt = $db->prepare("
        UPDATE users 
        SET username = ?, email = ?, full_name = ?, phone = ?, 
            date_of_birth = ?, address = ?, profile_image = ?, updated_at = NOW()
        WHERE id = ?
    ");
    
    return $stmt->execute([
        $username, $email, $fullName, $phone, 
        $dateOfBirth, $address, $profileImage, $id
    ]);
}

// Booking management functions
function createBooking($userId, $roomId, $checkinDate, $checkoutDate, $guests, $totalPrice, $specialRequests = null)
{
    $db = Database::getConnection();
    $stmt = $db->prepare("INSERT INTO bookings (user_id, room_id, checkin_date, checkout_date, guests, total_price, special_requests, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, 'confirmed', NOW())");
    return $stmt->execute([$userId, $roomId, $checkinDate, $checkoutDate, $guests, $totalPrice, $specialRequests]);
}

function getBookingsByUserId($userId)
{
    $db = Database::getConnection();
    $stmt = $db->prepare("
        SELECT b.*, r.name as room_name, r.type as room_type, 
               JSON_UNQUOTE(JSON_EXTRACT(r.images, '$[0]')) as room_image
        FROM bookings b 
        JOIN rooms r ON b.room_id = r.id 
        WHERE b.user_id = ? 
        ORDER BY b.created_at DESC
    ");
    $stmt->execute([$userId]);
    $bookings = $stmt->fetchAll();

    // Add compatibility fields
    foreach ($bookings as &$booking) {
        $booking['checkin'] = $booking['checkin_date'];
        $booking['checkout'] = $booking['checkout_date'];
        // Calculate adults and children (simplified)
        $booking['adults'] = $booking['guests'];
        $booking['children'] = 0;
    }

    return $bookings;
}

function getBookingById($id)
{
    $db = Database::getConnection();
    $stmt = $db->prepare("
        SELECT b.*, r.name as room_name, r.type as room_type, 
               JSON_UNQUOTE(JSON_EXTRACT(r.images, '$[0]')) as room_image
        FROM bookings b 
        JOIN rooms r ON b.room_id = r.id 
        WHERE b.id = ?
    ");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function cancelBooking($id, $userId)
{
    $db = Database::getConnection();
    $stmt = $db->prepare("UPDATE bookings SET status = 'cancelled', updated_at = NOW() WHERE id = ? AND user_id = ?");
    return $stmt->execute([$id, $userId]);
}

function getRecentBookings($limit = 10)
{
    $db = Database::getConnection();
    $stmt = $db->prepare("
        SELECT b.*, r.name as room_name, r.type as room_type, u.full_name as user_name
        FROM bookings b 
        JOIN rooms r ON b.room_id = r.id 
        JOIN users u ON b.user_id = u.id
        WHERE b.status = 'confirmed'
        ORDER BY b.created_at DESC 
        LIMIT ?
    ");
    $stmt->execute([$limit]);
    return $stmt->fetchAll();
}

// Utility functions
function isRoomAvailable($roomId, $checkinDate, $checkoutDate)
{
    $db = Database::getConnection();
    $stmt = $db->prepare("
        SELECT COUNT(*) as count 
        FROM bookings 
        WHERE room_id = ? 
        AND status = 'confirmed'
        AND (
            (checkin_date <= ? AND checkout_date > ?) OR
            (checkin_date < ? AND checkout_date >= ?) OR
            (checkin_date >= ? AND checkout_date <= ?)
        )
    ");
    $stmt->execute([$roomId, $checkinDate, $checkinDate, $checkoutDate, $checkoutDate, $checkinDate, $checkoutDate]);
    $result = $stmt->fetch();
    return $result['count'] == 0;
}

function getUserBookingStats($userId)
{
    $db = Database::getConnection();
    $stmt = $db->prepare("
        SELECT 
            COUNT(*) as total_bookings,
            COUNT(CASE WHEN status = 'confirmed' THEN 1 END) as confirmed_bookings,
            COUNT(CASE WHEN status = 'pending' THEN 1 END) as pending_bookings,
            COUNT(CASE WHEN status = 'cancelled' THEN 1 END) as cancelled_bookings,
            COALESCE(SUM(CASE WHEN status = 'confirmed' THEN total_price END), 0) as total_spent,
            0 as favorite_rooms
        FROM bookings 
        WHERE user_id = ?
    ");
    $stmt->execute([$userId]);
    return $stmt->fetch();
}



function getAllHotels()
{
    $pdo = Database::getConnection();
    $stmt = $pdo->query("SELECT * FROM hotels");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function getAllRooms()
{
    $pdo = Database::getConnection();
    $stmt = $pdo->query("SELECT * FROM rooms");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getHotelsBySearch($search = '')
{
    error_log("DEBUG: Inside getHotelsBySearch() with search = $search");

    $pdo = Database::getConnection();

    if (empty($search)) {
        $stmt = $pdo->query("SELECT * FROM hotels");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    $sql = "SELECT * FROM hotels WHERE name LIKE :term OR address LIKE :term2";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':term' => '%' . $search . '%',
        ':term2' => '%' . $search . '%'
    ]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

