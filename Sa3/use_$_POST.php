<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form - POST</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            background:#f2f2f2;
        }

        .container{
            width:600px;
            margin:30px auto;
            background:white;
            padding:20px;
            border-radius:10px;
            box-shadow:0px 0px 10px gray;
        }

        h2{
            text-align:center;
        }

        input{
            width:100%;
            padding:10px 0;
            margin-top:5px;
            margin-bottom:15px;
        }

        input[type=submit]{
            background:#007BFF;
            color:white;
            border:none;
            cursor:pointer;
        }

        input[type=submit]:hover{
            background:#0056b3;
        }

        .submit-group{
            text-align:center;
        }

        .result{
            margin-top:30px;
            background:#e9f5ff;
            padding:15px;
            border-radius:10px;
        }

        .error{
            color:red;
            font-weight:bold;
        }
    </style>
</head>
<body>

    <div class="container">

        <h2>Registration Form (POST)</h2>

        <form method="POST">
            <div class="form-group">   
                <label for="fname">First Name:</label></br>
                <input type="text" name="fname" required>
            </div>
            <div class="form-group">
                <label for="mname">Middle Name:</label></br>
                <input type="text" name="mname" required>
            </div>

            <div class="form-group">
                <label for="lname">Last Name:</label></br>
                <input type="text" name="lname" required>
            </div>

            <div class="form-group">
                <label for="username">Username:</label></br>
                <input type="text" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label></br>
                <input type="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="confirm">Confirm Password:</label></br>
                <input type="password" name="confirm" required>
            </div>

            <div class="form-group">
                <label for="birthday">Birthday:</label></br>
                <input type="date" name="birthday" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label></br>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="contact">Contact Number:</label></br>
                <input type="text" name="contact" required>
            </div>

            <div class="submit-group">
            <input type="submit" value="Register">
            </div>
        </form>

        <?php

        if(isset($_POST['fname'])){
            if($_POST['password']==$_POST['confirm']){
                
                $fname=$_POST['fname'];
                $mname=$_POST['mname'];
                $lname=$_POST['lname'];
                $username=$_POST['username'];
                $password=$_POST['password'];
                $confirm=$_POST['confirm'];
                $birthday=$_POST['birthday'];
                $email=$_POST['email'];
                $contact=$_POST['contact'];

                echo "<div class='result'>";

                echo "<h3>Registration Details</h3>";

                echo "First Name: $fname <br>";
                echo "Middle Name: $mname <br>";
                echo "Last Name: $lname <br>";
                echo "Username: $username <br>";
                echo "Birthday: $birthday <br>";
                echo "Email: $email <br>";
                echo "Contact Number: $contact";

            }else{
                echo "<p class='error'>Password and Confirm Password are not the same.</p>";
            }
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>