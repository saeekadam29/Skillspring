<?php
session_start();
require 'db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["error" => "Invalid request"]);
    exit;
}

$email    = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (!$email || !$password) {
    echo json_encode(["error" => "Please fill in all fields."]);
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user || !password_verify($password, $user['password'])) {
        echo json_encode(["error" => "Invalid email or password."]);
        exit;
    }

    $_SESSION['user_id']    = $user['id'];
    $_SESSION['user_name']  = $user['name'];
    $_SESSION['user_email'] = $user['email'];

    // Log login
    $ip  = $_SERVER['REMOTE_ADDR'];
    $log = $pdo->prepare("INSERT INTO activity_logs (user_id, action, ip_address) VALUES (?, 'login', ?)");
    $log->execute([$user['id'], $ip]);

    echo json_encode([
        "success"  => true,
        "redirect" => "index (6).html"
    ]);

} catch (Exception $e) {
    echo json_encode(["error" => "Server error: " . $e->getMessage()]);
}
?>
