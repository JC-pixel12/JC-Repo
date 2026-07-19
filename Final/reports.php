<?php
session_start();
require('audit.php');

if (!isset($_SESSION['seller_logged_in']) || $_SESSION['seller_logged_in'] !== true) {
    header('Location: seller_login.php');
    exit;
}

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'db_user_profile';

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$entries = getAuditEntries($conn);
require('seller_header.php');
?>

<div class="container py-4">
    <h2 class="mb-4">Audit Log Report</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($entries && mysqli_num_rows($entries) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($entries)): ?>
                            <tr>
                                <td><?= (int)$row['seller_id']; ?></td>
                                <td><?= htmlspecialchars(trim(($row['first_name'] ?? '') . ' ' . ($row['last_name'] ?? ''))); ?></td>
                                <td><?= htmlspecialchars($row['email'] ?? ''); ?></td>
                                <td><?= htmlspecialchars($row['action_date']); ?></td>
                                <td><?= htmlspecialchars($row['action_time']); ?></td>
                                <td><?= htmlspecialchars($row['action']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-muted">No audit records found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require('footer.php'); ?>
