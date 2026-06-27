<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>String Functions in PHP</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
        }

        h1{
            text-align: center;
            color: #333;
        }

        table{
            width: 100%;
            border: 1px solid black;
            background-color: white;
        }

        th, td{
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }

        th{
            background-color: #007BFF;
            color: white;
        }

        tr:nth-child(even){
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h1>PHP String Functions</h1>

    <?php
    $names = array(
        "john", "anna", "mark", "bea", "carlos",
        "diana", "ethan", "faith", "george", "zara",
        "karen", "leo", "michael", "nina", "oliver",
        "paula", "quentin", "rachel", "samuel", "victor"
    );
    ?>

    <table>
        <tr>
            <th colspan="6">List of Names</th>
        </tr>

        <tr>
            <th>Name</th>
            <th>Number of Characters</th>
            <th>Uppercase First Character</th>
            <th>Replace Vowels with @</th>
            <th>Check Position of Letter 'a'</th>
            <th>Reverse Name</th>
        </tr>

        <?php
        foreach($names as $name){

            // Number of characters including spaces
            $charCount = strlen($name);

            // Uppercase first character
            $upperFirst = ucfirst($name);

            // Replace vowels with @
            $replaceVowels = str_ireplace(
                array('a','e','i','o','u'),
                '@',
                $name
            );

            // Position of letter a
            $positionA = stripos($name, 'a');

            if($positionA === false){
                $positionA = "Not Found";
            }

            // Reverse format
            $reverseName = strrev($name);

            echo "<tr>";
            echo "<td>$name</td>";
            echo "<td>$charCount</td>";
            echo "<td>$upperFirst</td>";
            echo "<td>$replaceVowels</td>";
            echo "<td>$positionA</td>";
            echo "<td>$reverseName</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>