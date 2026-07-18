<?php
function getSellerInitials($fullName) {
    $parts = preg_split('/\s+/', trim($fullName));
    $initials = '';
    foreach ($parts as $part) {
        if ($part !== '') {
            $initials .= strtoupper(substr($part, 0, 1));
        }
    }
    return $initials ?: 'U';
}

$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        .nav-link.active {
            font-weight: 700;
            color: #0d6efd !important;
            border-bottom: 2px solid #0d6efd;
        }
        .seller-initials {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border: 2px solid #0d6efd;
            border-radius: 8px;
            font-weight: 700;
            color: #0d6efd;
            background-color: #eef5ff;
            text-decoration: none;
        }
    </style>
    <title>Seller Header</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold me-4" href="seller_homepage.php">
                <img src="images/iTamamo2.png" alt="Company Logo" class="img-fluid" style="max-height: 40px; height: 40px; width: 200px; object-fit: cover;">
            </a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= $currentPage === 'seller_homepage.php' ? 'active' : '' ?>" href="seller_homepage.php">Homepage</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $currentPage === 'user_management.php' ? 'active' : '' ?>" href="user_management.php">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $currentPage === 'inventory_management.php' ? 'active' : '' ?>" href="inventory_management.php">Inventory</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $currentPage === 'reports.php' ? 'active' : '' ?>" href="reports.php">Reports</a>
                    </li>
                </ul>
                <a href="seller_homepage.php" class="seller-initials" aria-label="Seller profile">
                    <?= htmlspecialchars(getSellerInitials($_SESSION['seller_name'] ?? 'Unknown User')); ?>
                </a>
            </div>
        </div>
    </nav>
</body>
</html>
