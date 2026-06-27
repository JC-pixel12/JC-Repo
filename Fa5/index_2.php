
<?php
if (isset($_POST['submit'])) {
    setcookie("firstname", $_POST['firstname'], time() + 5);
    setcookie("middlename", $_POST['middlename'], time() + 5);
    setcookie("lastname", $_POST['lastname'], time() + 5);
    setcookie("dob", $_POST['dob'], time() + 5);
    setcookie("address", $_POST['address'], time() + 5);

    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cookie</title>
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
        <h1>Personal Information Form (Cookie)</h1>

        <div class="box">
            <form method="post" action="">
                First Name: <input type="text" name="firstname"><br><br>
                Middle Name: <input type="text" name="middlename"><br><br>
                Last Name: <input type="text" name="lastname"><br><br>
                Date of Birth: <input type="date" name="dob"><br><br>
                Address: <input type="text" name="address"><br><br>

                <input type="submit" name="submit" value="Submit">
            </form>
        </div>
        
        <div class="box">
            <?php
            if (isset($_COOKIE['firstname'])) {
                echo "<h3>Stored Cookie Values:</h3>";
                echo "First Name: " . $_COOKIE['firstname'] . "<br>";
                echo "Middle Name: " . $_COOKIE['middlename'] . "<br>";
                echo "Last Name: " . $_COOKIE['lastname'] . "<br>";
                echo "Date of Birth: " . $_COOKIE['dob'] . "<br>";
                echo "Address: " . $_COOKIE['address'] . "<br>";
            } else {
                echo "<h3>No cookies</h3>";
            }
            ?>

        </div>
    </div>
</body>
</html>
