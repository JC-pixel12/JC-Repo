<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$initials = '';
if (!empty($_SESSION['username'])) {
    $email = trim($_SESSION['username']);
    $stmt = $conn_name->prepare("SELECT first_name, last_name FROM tbl_customer_profile WHERE email = ? LIMIT 1");
    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $profile = $result->fetch_assoc();
        $firstName = $profile['first_name'] ?? '';
        $lastName = $profile['last_name'] ?? '';

        if ($firstName !== '') {
            $initials .= strtoupper(substr($firstName, 0, 1));
        }
        if ($lastName !== '') {
            $initials .= strtoupper(substr($lastName, 0, 1));
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <title>TrailBlazer Music</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold me-4" href="homepage.php">
                <img src="../images/iTamamo2.png" alt="Company Logo" class="img-fluid" 
                    style="max-height: 50px; height: 50px; width: 250px; object-fit: cover;">
            </a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="product_catalogue.php">Product Catalogue</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                </ul>
                <?php if ($initials !== ''): ?>
                    <a href="user_information.php" class="nav-link" aria-label="User profile" title="User profile">
                        <span class="rounded-circle bg-dark text-white d-inline-flex align-items-center justify-content-center" 
                                style="width: 40px; height: 40px; font-weight: bold;">
                            <?= htmlspecialchars($initials); ?>
                        </span>
                    </a>
                <?php else: ?>
                    <a href="registration.php" class="nav-link" aria-label="Not logged in or registered" title="Not logged in or registered">
                        <i class="bi bi-person-x-fill fs-4 text-secondary">User</i>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <div class="container m-5">
