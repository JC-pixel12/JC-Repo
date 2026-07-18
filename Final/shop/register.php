<?php
    require('db.php');
    require('mailer.php');

    $message = '';
    $type = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $first_name = mysqli_real_escape_string($conn, trim($_POST['fname']));
        $middle_name = mysqli_real_escape_string($conn, trim($_POST['mname']));
        $last_name = mysqli_real_escape_string($conn, trim($_POST['lname']));
        $address = mysqli_real_escape_string($conn, trim($_POST['address']));
        $contact = mysqli_real_escape_string($conn, trim($_POST['contact']));
        $email = mysqli_real_escape_string($conn, trim($_POST['email']));
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $verificationToken = bin2hex(random_bytes(32));

        $sql = "SELECT id, is_verified FROM tbl_customer_profile WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $existingUser = mysqli_fetch_assoc($result);

        if ($_POST['password'] !== $_POST['cpassword']) {
            $message = "Passwords do not match.";
            $type = "danger";
        } elseif ($existingUser) {
            if (!empty($existingUser['is_verified'])) {
                $message = "Email already exists.";
                $type = "danger";
            } else {
                $message = "This email is already registered but has not been verified yet. Please check your inbox for the verification message.";
                $type = "warning";
            }
        } else {
            $sql = "INSERT INTO tbl_customer_profile (
                        first_name, middle_name, last_name, email,
                        password, address, contact, is_verified,
                        verification_token, created_at)
                    VALUES (
                        '$first_name', '$middle_name', '$last_name',
                        '$email', '$password', '$address', '$contact', 0,
                        '$verificationToken', NOW())";

            if (mysqli_query($conn, $sql)) {
                try {
                    sendEmail($email, trim($first_name . ' ' . $last_name), $verificationToken);
                    $message = "Registration successful. Please check your email and verify your address before you can log in.";
                    $type = "success";
                } catch (Exception $e) {
                    $message = "Registration successful, but the verification email failed to send.";
                    $type = "warning";
                }
            } else {
                $message = "Error: " . $sql . "<br>" . mysqli_error($conn);
                $type = "danger";
            }
        }
    }
?>