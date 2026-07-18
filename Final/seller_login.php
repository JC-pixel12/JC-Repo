<?php
session_start();

require('audit.php');

$host = "localhost";
$user = "root";
$password = "";
$dbname = "db_user_profile";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = '';
$type = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
    $plain_password = $_POST['password'] ?? '';

    $sql = "SELECT * FROM tbl_seller WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $seller = mysqli_fetch_assoc($result);
        if (password_verify($plain_password, $seller['password'])) {
            $_SESSION['seller_logged_in'] = true;
            $_SESSION['seller_id'] = $seller['id'];
            $_SESSION['seller_name'] = trim($seller['first_name'] . ' ' . $seller['last_name']);
            $_SESSION['seller_email'] = $seller['email'];
            $_SESSION['seller_role'] = $seller['role'];
            logAuditAction($conn, $seller['id'], 'Login');

            header('Location: seller_homepage.php');
            exit;
        } else {
            $message = "Incorrect password.";
            $type = "danger";
        }
    } else {
        $message = "Email does not exist.";
        $type = "danger";
    }
}

require('seller_header.php');
?>

<div class="d-flex justify-content-center">
    <div class="col-md-4">
        <h2 class="mb-2">Seller Login</h2>
        <?php if ($message): ?>
            <div class="alert alert-<?= $type; ?> alert-dismissible fade show" role="alert">
                <?= $message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="seller_login.php" method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Log In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require('footer.php'); ?>

