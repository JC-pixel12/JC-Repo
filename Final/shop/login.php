<?php
    include("db.php");

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

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
        $email = trim($_POST['email'] ?? '');
        $passwords = $_POST['password'] ?? '';
        $remember_me = isset($_POST['remember_me']) ? 1 : 0;

        $sellerStmt = $conn_name->prepare("SELECT * FROM tbl_seller WHERE email = ? LIMIT 1");
        $seller = null;
        if ($sellerStmt) {
            $sellerStmt->bind_param("s", $email);
            $sellerStmt->execute();
            $sellerResult = $sellerStmt->get_result();
            $seller = $sellerResult->fetch_assoc();
            $sellerStmt->close();
        }

        if ($seller && password_verify($passwords, $seller['password'])) {
            $role = strtolower($seller['role'] ?? 'standard');
            if ($role === 'admin') {
                $_SESSION['seller_logged_in'] = true;
                $_SESSION['seller_id'] = $seller['id'];
                $_SESSION['seller_name'] = trim(($seller['first_name'] ?? '') . ' ' . ($seller['last_name'] ?? ''));
                $_SESSION['seller_email'] = $seller['email'];
                $_SESSION['seller_role'] = $role;

                if ($remember_me) {
                    setcookie('remember_email', $email, time() + (86400 * 30), "/");
                    setcookie('remember_password', $passwords, time() + (86400 * 30), "/");
                } else {
                    setcookie('remember_email', '', time() - 3600, "/");
                    setcookie('remember_password', '', time() - 3600, "/");
                }

                header("Location: ../seller_homepage.php");
                exit();
            } else {
                $message = "This seller account does not have admin privileges.";
                $type = "warning";
            }
        } else {
            $customerStmt = $conn_name->prepare("SELECT * FROM tbl_customer_profile WHERE email = ? LIMIT 1");
            $user = null;
            if ($customerStmt) {
                $customerStmt->bind_param("s", $email);
                $customerStmt->execute();
                $customerResult = $customerStmt->get_result();
                $user = $customerResult->fetch_assoc();
                $customerStmt->close();
            }

            if ($user && password_verify($passwords, $user['password'])) {
                if (empty($user['is_verified'])) {
                    $message = "Please verify your email address before logging in. Check your inbox for the verification link.";
                    $type = "warning";
                } else {
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
    }
?>