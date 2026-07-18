<?php
    include("db.php");

    $message = "";
    $type = "";
    $remembered_email = "";
    $remembered_password = "";
    $remember_checked = false;

    if (isset($_COOKIE['remember_email'])) {
        $remembered_email = $_COOKIE['remember_email'];
        $remember_checked = true;
    }

    if (isset($_COOKIE['remember_password'])) {
        $remembered_password = $_COOKIE['remember_password'];
        $remember_checked = true;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = mysqli_real_escape_string($conn_name, trim($_POST['email']));
        $passwords = $_POST['password'];
        $remember_me = isset($_POST['remember_me']) ? 1 : 0;

        $sql = "SELECT * FROM tbl_customer_profile WHERE email = '$email' LIMIT 1";
        $result = $conn_name->query($sql);
        $user = $result->fetch_assoc();

        if ($user && password_verify($passwords, $user['password'])) {
            if (empty($user['is_verified'])) {
                $message = "Please verify your email address before logging in. Check your inbox for the verification link.";
                $type = "warning";
            } else {
                session_start();
                $_SESSION['username'] = $user['email'];

                if ($remember_me) {
                    setcookie('remember_email', $email, time() + (86400 * 30), "/");
                    setcookie('remember_password', $passwords, time() + (86400 * 30), "/");
                } else {
                    setcookie('remember_email', '', time() - 3600, "/");
                    setcookie('remember_password', '', time() - 3600, "/");
                }

                header("Location: user_information.php");
                exit();
            }
        } else {
            $message = "Not found, incorrect email or password.";
            $type = "danger";
        }
    }
?>
