<?php
session_start();
require('db.php');

$message = "";
$type = "";

    // Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login_page.php");
    exit();
}

require('reset_password.php');

    // Fetch user information
$username = mysqli_real_escape_string($conn, $_SESSION['username']);
$sql = "SELECT first_name, middle_name, last_name, username, birthday, email, contact 
        FROM tbluser 
        WHERE username = '$username' LIMIT 1";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

    // Format the birthday if it exists
if ($user && !empty($user['birthday'])) {
    $birthday = date('F d, Y', strtotime($user['birthday']));
} else {
    $birthday = 'Not available';
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
    <title>Homepage</title>
</head>
<body>
    <div class="container m-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="mb-3">Welcome to the Homepage</h1>
                    <!-- Display messages if any (success or error) -->
                <?php if ($message): ?>
                    <div class="alert alert-<?= $type; ?> alert-dismissible fade show" role="alert">
                        <?= htmlspecialchars($message); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>
                <?php if ($user): ?>
                    <p class="lead">Hello, <?php echo htmlspecialchars(
                        $user['first_name'] . ' ' . 
                        $user['middle_name'] . ' ' . 
                        $user['last_name']); ?>!
                    </p>

                    <ul class="list-unstyled mt-3">
                        <li><strong>Birthday:</strong> <?php echo htmlspecialchars($birthday); ?></li>
                        <li><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></li>
                        <li><strong>Phone Number:</strong> <?php echo htmlspecialchars($user['contact']); ?></li>
                    </ul>
                    
                    <div class="d-flex gap-2 mt-4">
                        <a href="logout.php" class="btn btn-danger">Logout</a>
                    </div>

                    <div class="card mt-4">
                        <div class="card-body">
                            <h4 class="mb-3">Reset Password</h4>
                            <form action="user_information.php" method="post">
                                <input type="hidden" name="reset_password" value="1">
                                <div class="mb-3">
                                    <label class="form-label">Current Password</label>
                                    <input type="password" name="old_password" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">New Password</label>
                                    <input type="password" name="new_password" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Re-enter New Password</label>
                                    <input type="password" name="confirm_password" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-warning">Update Password</button>
                            </form>
                        </div>
                    </div>

                <?php else: ?>
                    <p class="text-danger">No account information was found.</p>
                    <a href="login_page.php" class="btn btn-primary">Login again</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxI"
        crossorigin="anonymous"></script>
</body>
</html>