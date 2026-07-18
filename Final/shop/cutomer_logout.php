<?php
session_start();

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'db_user_profile';

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

if (!empty($_SESSION['seller_id'])) {
    logAuditAction($conn, $_SESSION['seller_id'], 'Logout');
}

session_unset();
session_destroy();
header('Location: login_page.php');
exit();
?>