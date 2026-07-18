<?php
session_start();

if (!isset($_SESSION['seller_logged_in']) || $_SESSION['seller_logged_in'] !== true) {
    header('Location: seller_login.php');
    exit;
}

require('seller_header.php');
?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Seller Dashboard</h2>
        <a href="logout.php" class="btn btn-outline-danger">Logout</a>
    </div>
    <div class="card shadow-sm">
        <div class="card-body">
            <p><strong>Name:</strong> <?= htmlspecialchars($_SESSION['seller_name'] ?? 'N/A'); ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($_SESSION['seller_email'] ?? 'N/A'); ?></p>
            <p><strong>Role:</strong> <?= htmlspecialchars($_SESSION['seller_role'] ?? 'N/A'); ?></p>
        </div>
    </div>
</div>

<?php require('footer.php'); ?>