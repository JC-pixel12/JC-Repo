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

$currentRole = strtolower($_SESSION['seller_role'] ?? 'standard');
$isAdmin = ($currentRole === 'admin');
$message = '';
$type = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $isAdmin) {
    if (isset($_POST['add_user'])) {
        $firstName = mysqli_real_escape_string($conn, $_POST['first_name'] ?? '');
        $middleName = mysqli_real_escape_string($conn, $_POST['middle_name'] ?? '');
        $lastName = mysqli_real_escape_string($conn, $_POST['last_name'] ?? '');
        $email = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
        $password = password_hash($_POST['password'] ?? '', PASSWORD_DEFAULT);
        $role = ($_POST['role'] === 'admin') ? 'admin' : 'standard';

        if ($firstName && $lastName && $email && $_POST['password'] !== '') {
            $checkEmail = mysqli_query($conn, "SELECT id FROM tbl_seller WHERE email = '$email' LIMIT 1");
            if (mysqli_num_rows($checkEmail) === 0) {
                $sql = "INSERT INTO tbl_seller (first_name, middle_name, last_name, password, email, role) VALUES ('$firstName', '$middleName', '$lastName', '$password', '$email', '$role')";
                if (mysqli_query($conn, $sql)) {
                    logAuditAction($conn, $_SESSION['seller_id'] ?? 0, 'Add User');
                    $message = 'User added successfully.';
                    $type = 'success';
                } else {
                    $message = 'Failed to add user.';
                    $type = 'danger';
                }
            } else {
                $message = 'Email already exists.';
                $type = 'danger';
            }
        } else {
            $message = 'Please fill in all required fields.';
            $type = 'danger';
        }
    } elseif (isset($_POST['remove_user'])) {
        $userId = (int)($_POST['user_id'] ?? 0);
        if ($userId > 0) {
            $sql = "DELETE FROM tbl_seller WHERE id = $userId";
            if (mysqli_query($conn, $sql)) {
                logAuditAction($conn, $_SESSION['seller_id'] ?? 0, 'Remove User');
                $message = 'User removed successfully.';
                $type = 'success';
            } else {
                $message = 'Failed to remove user.';
                $type = 'danger';
            }
        }
    } elseif (isset($_POST['change_role'])) {
        $userId = (int)($_POST['user_id'] ?? 0);
        $newRole = ($_POST['role'] === 'admin') ? 'admin' : 'standard';
        if ($userId > 0) {
            $sql = "UPDATE tbl_seller SET role = '$newRole' WHERE id = $userId";
            if (mysqli_query($conn, $sql)) {
                logAuditAction($conn, $_SESSION['seller_id'] ?? 0, 'Modify User');
                $message = 'User role updated successfully.';
                $type = 'success';
            } else {
                $message = 'Failed to update role.';
                $type = 'danger';
            }
        }
    }
}

$result = mysqli_query($conn, 'SELECT id, first_name, middle_name, last_name, email, role FROM tbl_seller ORDER BY first_name');
require('seller_header.php');
?>

<div class="container py-4">
    <h2 class="mb-4">User Management</h2>

    <?php if ($message): ?>
        <div class="alert alert-<?= $type; ?>" role="alert">
            <?= htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <?php if ($isAdmin): ?>
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h4 class="h5">Add New User</h4>
                <form method="post" class="row g-3">
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="first_name" placeholder="First Name" required>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="middle_name" placeholder="Middle Name">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
                    </div>
                    <div class="col-md-3">
                        <input type="email" class="form-control" name="email" placeholder="Email" required>
                    </div>
                    <div class="col-md-3">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" name="role">
                            <option value="standard">Standard</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary" name="add_user">Add User</button>
                    </div>
                </form>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-info">You can view the user list, but only administrators can add, remove, or change roles.</div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="h5">Seller Accounts</h4>
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= htmlspecialchars(trim(($row['first_name'] ?? '') . ' ' . ($row['middle_name'] ?? '') . ' ' . ($row['last_name'] ?? ''))); ?></td>
                            <td><?= htmlspecialchars($row['email'] ?? ''); ?></td>
                            <td><?= htmlspecialchars(ucfirst($row['role'] ?? 'standard')); ?></td>
                            <td>
                                <?php if ($isAdmin): ?>
                                    <form method="post" class="d-inline">
                                        <input type="hidden" name="user_id" value="<?= (int)$row['id']; ?>">
                                        <select class="form-select form-select-sm d-inline-block w-auto" name="role">
                                            <option value="standard" <?= strtolower($row['role'] ?? 'standard') === 'standard' ? 'selected' : ''; ?>>Standard</option>
                                            <option value="admin" <?= strtolower($row['role'] ?? 'standard') === 'admin' ? 'selected' : ''; ?>>Admin</option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-outline-secondary" name="change_role">Update</button>
                                    </form>
                                    <form method="post" class="d-inline ms-2">
                                        <input type="hidden" name="user_id" value="<?= (int)$row['id']; ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger" name="remove_user">Remove</button>
                                    </form>
                                <?php else: ?>
                                    <span class="text-muted">View Only</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require('footer.php'); ?>