<?php
// Variables needed to store connection values
$host = "localhost";
$user = "root";
$password = "";
$dbname = "db_user_profile";
$dbproduct = "db_product";

// Create a connection to the User_Profile database
$conn_name = new mysqli($host, $user, $password, $dbname);

if ($conn_name->connect_error) {
    die("Connection failed: " . $conn_name->connect_error);
}

// Create a connection to the Product database
$conn_product = new mysqli($host, $user, $password, $dbproduct);

if ($conn_product->connect_error) {
    die("Connection failed: " . $conn_product->connect_error);
}

?>