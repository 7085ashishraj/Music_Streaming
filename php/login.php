<?php
header('Content-Type: application/json');
require_once 'config.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get raw POST data
$input = json_decode(file_get_contents('php://input'), true);

$username = $input['username'] ?? '';
$password = $input['password'] ?? '';

try {
    // Validate input
    if (empty($username) || empty($password)) {
        throw new Exception('Username and password are required');
    }

    // Check if username or email exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    if (!$stmt->execute([$username, $username])) {
        throw new Exception('Database query failed');
    }

    $user = $stmt->fetch();
    
    if (!$user) {
        throw new Exception('Invalid username or email');
    }

    if (!password_verify($password, $user['password'])) {
        throw new Exception('Invalid password');
    }

    // Start secure session
    session_start();
    session_regenerate_id(true);
    
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
    $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
    $_SESSION['last_login'] = time();

    echo json_encode([
        'success' => true,
        'message' => 'Login successful',
        'username' => $user['username'],
        'user_id' => $user['id'],
        'redirect' => 'index.html'
    ]);

} catch (Exception $e) {
    error_log('Login error: ' . $e->getMessage());
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage(),
        'error_details' => 'Please check your credentials and try again'
    ]);
}
?>