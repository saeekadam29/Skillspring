<?php
session_start();
require 'db.php';

if (isset($_SESSION['user_id'])) {
    $ip  = $_SERVER['REMOTE_ADDR'];
    $log = $pdo->prepare("INSERT INTO activity_logs (user_id, action, ip_address) VALUES (?, 'logout', ?)");
    $log->execute([$_SESSION['user_id'], $ip]);
}

session_unset();
session_destroy();

header("Location: login.php");
exit();
?>
