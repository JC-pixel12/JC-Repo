<?php
require('db.php');

$message = '';
$type = 'success';

if (isset($_GET['token']) && $_GET['token'] !== '') {
    ensure_customer_profile_verification_columns($conn);

    $token = mysqli_real_escape_string($conn, trim($_GET['token']));
    $sql = "SELECT id, email, is_verified FROM tbl_customer_profile WHERE verification_token = '$token' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        if (!empty($user['is_verified'])) {
            $message = 'This email address has already been verified.';
            $type = 'info';
        } else {
            $updateSql = "UPDATE tbl_customer_profile SET is_verified = 1, verification_token = NULL, verified_at = NOW() WHERE id = {$user['id']}";
            if (mysqli_query($conn, $updateSql)) {
                $message = 'Your email address has been verified successfully. You can now log in.';
            } else {
                $message = 'Unable to verify your email address right now.';
                $type = 'danger';
            }
        }
    } else {
        $message = 'The verification link is invalid or has expired.';
        $type = 'danger';
    }
} else {
    $message = 'No verification token was provided.';
    $type = 'danger';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <title>Email Verification</title>
</head>
<body>
    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h1 class="h4 mb-3">Email Verification</h1>
                <?php if ($message): ?>
                    <div class="alert alert-<?= $type; ?>" role="alert">
                        <?= htmlspecialchars($message); ?>
                    </div>
                <?php endif; ?>
                <a href="login_page.php" class="btn btn-primary">Go to Login</a>
            </div>
        </div>
    </div>
</body>
</html>
