<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formula for Volume of Shapes</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Formula for Volume of Shapes</h1>

    <?php
        $shapes = array("cube", "prism", "cylinder", "pyramid", "sphere");

        function calculateVolume($values, $shape){
            # Cube
            if($shape == "cube") {
                return pow($values[0], 3);
            }

            #Right Rectangular Prism
            if($shape == "prism") {
                return $values[0] * $values[1] * $values[2];
            }

            #Prism or Cylinder
            if($shape == "cylinder") {
                return pi() * pow($values[0], 2) * $values[1];
            }

            #Pyramid or Cone
            if($shape == "pyramid") {
                return (1/3) * $values[0] * $values[1] * $values[2];
            }

            #Sphere
            if($shape == "sphere") {
                return (4/3) * pi() * pow($values[0], 3);
            }
        }

        function displayShape($shape){
            if($shape == "cube") {
                return "V = s³";
            }

            if($shape == "prism") {
                return "V = l × w × h";
            }

            if($shape == "cylinder") {
                return "V = πr²h";
            }

            if($shape == "pyramid") {
                return "V = (1/3) × l × w × h";
            }

            if($shape == "sphere") {
                return "V = (4/3)πr³";
            }
        }

        function displayValues($shape, $values){
            if($shape == "cube") {
                return "Side = " . $values[0];
            }

            if($shape == "prism") {
                return "Length = " . $values[0] . ", Width = " . $values[1] . ", Height = " . $values[2];
            }

            if($shape == "cylinder") {
                return "Radius = " . $values[0] . ", Height = " . $values[1];
            }

            if($shape == "pyramid") {
                return "Length = " . $values[0] . ", Width = " . $values[1] . ", Height = " . $values[2];
            }

            if($shape == "sphere") {
                return "Radius = " . $values[0];
            }
        }
    ?>

    <table>
        <tr>
            <th colspan="4">Volume of Shapes</th>
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