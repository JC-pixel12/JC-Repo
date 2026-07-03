<?php
// Variables needed to store connection values
$host = "localhost";
$user = "root";
$password = "";
$dbname = "user_register";

// Create a connection to the database
$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>