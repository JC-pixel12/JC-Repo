<?php
    require('db.php');

    $title = "Dog Registration Form";
    $message = '';
    $type = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $dog_name = mysqli_real_escape_string($conn, $_POST['dog_name']);
        $breed = mysqli_real_escape_string($conn, $_POST['breed']);
        $age = (int)$_POST['age'];
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $color = mysqli_real_escape_string($conn, $_POST['color']);
        $height = (float)$_POST['height'];
        $weight = (float)$_POST['weight'];

        $sql = "INSERT INTO tbldog 
                    (name, breed, age, address, color, height, weight) 
                VALUES 
                    ('$dog_name', '$breed', $age, '$address', '$color', $height, $weight)
                ";
        
        if (mysqli_query($conn, $sql)) {
            $message = "New dog registered successfully.";
            $type = "success";
        } else {
            $message = "Error: " . $sql . "<br>" . mysqli_error($conn);
            $type = "danger";
        }
    }
?>