<?php
    require('db.php');

    $message = '';
    $type = '';

        // Fetch all data from the Form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Sanitize and escape user input
            $first_name = mysqli_real_escape_string($conn, $_POST['fname']);
            $middle_name = mysqli_real_escape_string($conn, $_POST['mname']);
            $last_name = mysqli_real_escape_string($conn, $_POST['lname']);
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
            $contact = mysqli_real_escape_string($conn, $_POST['contact']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);

            $sql = "SELECT * FROM tbluser WHERE username = '$username'";
            $result = mysqli_query($conn, $sql);
            $count_user = mysqli_num_rows($result);

            $sql = "SELECT * FROM tbluser WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $count_email = mysqli_num_rows($result);

                // Check if either username or email already exists in the database
            if ($count_user == 0 && $count_email == 0) {
                    // Check if the password and confirm password fields match
                if ($_POST['password'] !== $_POST['cpassword']) {
                    $message = "Passwords do not match.";
                    $type = "danger";
                } else {
                        // Insert data into the database
                    $sql = "INSERT INTO tbluser (
                                first_name, middle_name, 
                                last_name, username, 
                                password, birthday, 
                                contact, email) 
                            VALUES (
                                '$first_name', '$middle_name', 
                                '$last_name', '$username', 
                                '$password', '$birthday', 
                                '$contact', '$email')";

                    if (mysqli_query($conn, $sql)) {
                        $message = "New user registered successfully.";
                        $type = "success";
                    } else {
                        $message = "Error: " . $sql . "<br>" . mysqli_error($conn);
                        $type = "danger";
                    }
                }
            } else {
                    // Handle the case where either username or email already exists
                if ($count_user > 0) {
                    $message = "Username already exists.";
                    $type = "danger";
                }
                if ($count_email > 0) {
                    $message = "Email already exists.";
                    $type = "danger";
                }
            }
    }
?>