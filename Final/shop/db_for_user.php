<?php
// Variables needed to store connection values
$host = "localhost";
$user = "root";
$password = "";
$dbname = "db_user_profile";

// Create a connection to the database
$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// function ensure_customer_profile_verification_columns($conn) {
//     $table = 'tbl_customer_profile';

//     $createTableSql = "CREATE TABLE IF NOT EXISTS `$table` (
//         `id` INT AUTO_INCREMENT PRIMARY KEY,
//         `first_name` VARCHAR(100) DEFAULT NULL,
//         `middle_name` VARCHAR(100) DEFAULT NULL,
//         `last_name` VARCHAR(100) DEFAULT NULL,
//         `email` VARCHAR(255) NOT NULL UNIQUE,
//         `password` VARCHAR(255) NOT NULL,
//         `address` VARCHAR(255) DEFAULT NULL,
//         `contact` VARCHAR(100) DEFAULT NULL,
//         `is_verified` TINYINT(1) NOT NULL DEFAULT 0,
//         `verification_token` VARCHAR(255) DEFAULT NULL,
//         `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
//         `verified_at` DATETIME DEFAULT NULL
//     )";

//     if (!$conn->query($createTableSql)) {
//         error_log("Unable to create table $table: " . $conn->error);
//         return;
//     }

//     $columns = [
//         'is_verified' => 'TINYINT(1) NOT NULL DEFAULT 0',
//         'verification_token' => 'VARCHAR(255) DEFAULT NULL',
//         'created_at' => 'DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP',
//         'verified_at' => 'DATETIME DEFAULT NULL'
//     ];

//     foreach ($columns as $name => $definition) {
//         $check = $conn->query("SHOW COLUMNS FROM `$table` LIKE '$name'");
//         if ($check && $check->num_rows === 0) {
//             $alterSql = "ALTER TABLE `$table` ADD COLUMN `$name` $definition";
//             if (!$conn->query($alterSql)) {
//                 error_log("Unable to add column $name: " . $conn->error);
//             }
//         }
//     }
// }

// function cleanup_unverified_accounts($conn, $days = 3) {
//     ensure_customer_profile_verification_columns($conn);

//     $sql = "DELETE FROM tbl_customer_profile WHERE is_verified = 0 AND created_at < DATE_SUB(NOW(), INTERVAL $days DAY)";
//     $conn->query($sql);
// }

// function build_verification_link($token) {
//     $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
//     $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
//     $path = dirname($_SERVER['PHP_SELF'] ?? '/');
//     $basePath = rtrim($path, '/');

//     return $scheme . '://' . $host . $basePath . '/email_confirmation.php?token=' . urlencode($token);
// }

// function send_verification_email($toEmail, $firstName, $token) {
//     $verificationLink = build_verification_link($token);
//     $subject = 'Please verify your email address';
//     $message = '<html><body>'
//         . '<p>Thank you for signing up, ' . htmlspecialchars($firstName, ENT_QUOTES, 'UTF-8') . '!</p>'
//         . '<p>We are sending this email to verify your address. If you did not sign up, this email will be deleted from our system after a few days.</p>'
//         . '<p><a href="' . htmlspecialchars($verificationLink, ENT_QUOTES, 'UTF-8') . '
//             " style="
//                 display:inline-block;
//                 padding:10px 20px;
//                 background-color:#0d6efd;
//                 color:#ffffff;
//                 text-decoration:none;
//                 border-radius:4px;"
//                 >Verify Email Address</a></p>'
//         . '<p>If the button does not work, copy and paste this link into your browser:</p>'
//         . '<p><a href="' . htmlspecialchars($verificationLink, ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($verificationLink, ENT_QUOTES, 'UTF-8') . '</a></p>'
//         . '</body></html>';

//     $headers = "MIME-Version: 1.0\r\n";
//     $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
//     $headers .= "From: no-reply@example.com\r\n";
//     $headers .= "Reply-To: no-reply@example.com\r\n";

//     return mail($toEmail, $subject, $message, $headers);
// }
?>