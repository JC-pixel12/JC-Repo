

<!DOCTYPE html>
<html>
<head>
    <title>Student Registration</title>
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

        <h1>Student Registration Form</h1>

        <form method="POST">

            <div class="box">
                <h3>Personal Profile</h3>

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

            <div class="box">
                <h3>Educational Background</h3>

                <label>School Name</label>
                <input type="text" name="school_name" required>

                <label>Level</label>
                <select name="level" required>
                    <option value="">--Select--</option>
                    <option>High School</option>
                    <option>Senior High School</option>
                    <option>College</option>
                </select>

                <label>Year Graduated</label>
                <input type="number" name="year_graduated" required>

                <label>GPA / Average</label>
                <input type="text" name="gpa" required>
            </div>

            <input type="submit" value="Register">

        </form>
    </div>
</body>
</html>