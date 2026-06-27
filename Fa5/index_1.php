
<?php
session_start();

$submitted = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $submitted = true;

    // Personal Information
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Personal Information</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial;
            background-color: #f4f4f4;
        }

        .container {
            width: 650px;
            margin: auto;
            margin-top: 20px;
        }

        h1 {
            text-align: center;
        }

        .box {
            background: white;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }

        h3 {
            margin-top: 0;
            background: #2a4563;
            color: white;
            padding: 8px;
            border-radius: 5px;
        }

        input, select, textarea {
            width: 100%;
            padding: 8px;
            margin: 5px 0 10px 0;
        }

        input[type="submit"] {
            background: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            padding: 10px;
        }

        .result {
            background: #e9ecef;
            padding: 15px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="container">

    <h2>Personal Information Form</h2>

    <form method="POST">
        <div class="box">
            <h3>Personal Info</h3>

            <label>First Name</label>
            <input type="text" name="first_name" required>

            <label>Last Name</label>
            <input type="text" name="last_name" required>

            <label>Gender</label>
            <select name="gender" required>
                <option value="">--Select--</option>
                <option>Male</option>
                <option>Female</option>
                <option>Other</option>
            </select>

            <label>Date of Birth</label>
            <input type="date" name="dob" required>

            <label>Email</label>
            <input type="email" name="email" required>

            <label>Phone Number</label>
            <input type="text" name="phone" required>

            <label>Address</label>
            <textarea name="address" required></textarea>
        </div>

        <input type="submit" value="Register">

    </form>

    <!-- Display Submitted Data -->
    <?php if ($submitted): ?>
        <div class="box result">
            <h3>Submitted Data</h3>

            <p><strong>Name:</strong> <?php echo "$firstName $lastName"; ?></p>
            <p><strong>Gender:</strong> <?php echo $gender; ?></p>
            <p><strong>Date of Birth:</strong> <?php echo $dob; ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
            <p><strong>Phone:</strong> <?php echo $phone; ?></p>
            <p><strong>Address:</strong> <?php echo $address; ?></p>
        </div>
    <?php endif; ?>

    <?php
        session_unset();
        session_destroy();  
    ?>
</div>

</body>
</html>
