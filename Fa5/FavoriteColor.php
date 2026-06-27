
<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Enter Favorite Colors</title>
</head>
<body>

<h2>Enter Your 5 Favorite Colors</h2>

<form action="ResultsColor.php" method="post" >
    Color 1: <input type="text" name="color1"><br><br>
    Color 2: <input type="text" name="color2"><br><br>
    Color 3: <input type="text" name="color3"><br><br>
    Color 4: <input type="text" name="color4"><br><br>
    Color 5: <input type="text" name="color5"><br><br>

    <input type="submit" name="submit" value="Submit">
</form>

</body>
</html>
