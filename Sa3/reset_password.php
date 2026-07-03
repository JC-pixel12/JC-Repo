<?php
if (!isset($_SESSION['username'])) {
    header("Location: login_page.php");
    exit();
}

$message = "";
$type = "";
$username = mysqli_real_escape_string($conn, $_SESSION['username']);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reset_password'])) {
    $old_password = $_POST['old_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

        // Fetch the current password hash from the database for the logged-in user
    $sql = "SELECT password FROM tbluser WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

        // Validate the old password, new password, and confirm password
    if (!$user) {
        $message = "User account was not found.";
        $type = "danger";
    } elseif (!password_verify($old_password, $user['password'])) {
        $message = "Your current password is incorrect.";
        $type = "danger";
    } elseif ($old_password === $new_password) {
        $message = "Your new password must be different from your old password.";
        $type = "danger";
    } elseif ($new_password !== $confirm_password) {
        $message = "The new password and re-entered password do not match.";
        $type = "danger";
    } else {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update_sql = "UPDATE tbluser SET password = '$hashed_password' WHERE username = '$username'";

        if (mysqli_query($conn, $update_sql)) {
            $message = "Password updated successfully.";
            $type = "success";
        } else {
            $message = "Password could not be updated. Please try again.";
            $type = "danger";
        }
    }
}
?>