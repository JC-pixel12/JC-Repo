<?php
session_start();
require('db.php');

$message = "";
$type = "";

if (!isset($_SESSION['username'])) {
    header("Location: login_page.php");
    exit();
}

require('reset_password.php');

$username = mysqli_real_escape_string($conn_name, $_SESSION['username']);
$sql = "SELECT first_name, middle_name, last_name, email, contact, is_verified 
        FROM tbl_customer_profile 
        WHERE email = '$username' LIMIT 1";
$result = mysqli_query($conn_name, $sql);
$user = mysqli_fetch_assoc($result);

$birthday = 'Not available';
require('header.php');
?>
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
                        trim($user['first_name'] . ' ' . $user['middle_name'] . ' ' . $user['last_name'])); ?>!
                    </p>

                    <ul class="list-unstyled mt-3">
                        <li><strong>Status:</strong> <?php echo htmlspecialchars(!empty($user['is_verified']) ? 'Verified' : 'Pending verification'); ?></li>
                        <li><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></li>
                        <li><strong>Phone Number:</strong> <?php echo htmlspecialchars($user['contact']); ?></li>
                    </ul>
                    
                    <div class="d-flex gap-2 mt-4">
                        <a href="customer_logout.php" class="btn btn-danger">Logout</a>
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
<?php require('../footer.php'); ?>