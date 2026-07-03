<?php
    include("db.php");

    $message = "";
    $type = "";
    $remembered_username = "";
    $remembered_password = "";
    $remember_checked = false;

        // Check if the "Remember Me" cookies are set and retrieve their values
    if (isset($_COOKIE['remember_username'])) {
        $remembered_username = $_COOKIE['remember_username'];
        $remember_checked = true;
    }

    if (isset($_COOKIE['remember_password'])) {
        $remembered_password = $_COOKIE['remember_password'];
        $remember_checked = true;
    }

        // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = mysqli_real_escape_string($conn, trim($_POST['username']));
        $passwords = $_POST['password'];
        $remember_me = isset($_POST['remember_me']) ? 1 : 0;

        $sql = "SELECT * FROM tbluser WHERE username = '$username' LIMIT 1";
        $result = $conn->query($sql);
        $user = $result->fetch_assoc();

            // Verify the password and handle login
        if ($user && password_verify($passwords, $user['password'])) {
            session_start();
            $_SESSION['username'] = $user['username'];
                // Set cookies for "Remember Me" if checked, otherwise clear them
            if ($remember_me) {
                setcookie('remember_username', $username, time() + (86400 * 30), "/");
                setcookie('remember_password', $passwords, time() + (86400 * 30), "/");
            } else {
                setcookie('remember_username', '', time() - 3600, "/");
                setcookie('remember_password', '', time() - 3600, "/");
            }

            header("Location: user_information.php");
            exit();
        } else {
            $message = "Not found, incorrect username or password.";
            $type = "danger";
        }
    }
?>