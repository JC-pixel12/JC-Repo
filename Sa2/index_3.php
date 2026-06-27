<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Resume</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Student Resume</h1>


    <table>
        <tr>
            <th colspan="2"><img src="face.jpg" alt="Student Image" width="150"></th>
            <th>Personal Information</th>
        </tr>

        <tr>
            <th>Shapes</th>
            <th>Values</th>
            <th>Formula</th>
            <th>Answer</th>
        </tr>

        <?php
        foreach($shapes as $shape){
            $values = array(rand(1, 10), rand(1, 10), rand(1, 10));
            echo "<tr>";
            echo "<td>{$shape}</td>";
            echo "<td>" . displayValues($shape, $values) . "</td>";
            echo "<td>" . displayShape($shape) . "</td>";
            echo "<td>" . calculateVolume($values, $shape) . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>