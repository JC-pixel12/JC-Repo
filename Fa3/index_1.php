<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Person Information Table</title>

    <style>
        img{
            width: 80px;
            height: 80px;
            border-radius: 10px;
        }
    </style>
    <link rel="stylesheet" href="style.css">  
</head>
<body>

    <h1>Person Information Table</h1>

    <?php
    $persons = array(

        array(
            "name" => "John Cruz",
            "image" => "face.jpg",
            "age" => 21,
            "birthday" => "2005-01-15",
            "contact" => "09171234567"
        ),

        array(
            "name" => "Anna Reyes",
            "image" => "face.jpg",
            "age" => 20,
            "birthday" => "2006-03-10",
            "contact" => "09181234567"
        ),

        array(
            "name" => "Mark Santos",
            "image" => "face.jpg",
            "age" => 22,
            "birthday" => "2004-07-21",
            "contact" => "09191234567"
        ),

        array(
            "name" => "Bea Garcia",
            "image" => "face.jpg",
            "age" => 19,
            "birthday" => "2007-11-09",
            "contact" => "09201234567"
        ),

        array(
            "name" => "Carlos Mendoza",
            "image" => "face.jpg",
            "age" => 23,
            "birthday" => "2003-05-12",
            "contact" => "09211234567"
        ),

        array(
            "name" => "Faith Ramos",
            "image" => "face.jpg",
            "age" => 21,
            "birthday" => "2005-09-14",
            "contact" => "09241234567"
        ),

        array(
            "name" => "George Lim",
            "image" => "face.jpg",
            "age" => 22,
            "birthday" => "2004-12-01",
            "contact" => "09251234567"
        ),

        array(
            "name" => "Diana Lopez",
            "image" => "face.jpg",
            "age" => 24,
            "birthday" => "2002-08-17",
            "contact" => "09221234567"
        ),

        array(
            "name" => "Ethan Flores",
            "image" => "face.jpg",
            "age" => 20,
            "birthday" => "2006-02-28",
            "contact" => "09231234567"
        ),

        array(
            "name" => "Zara Villanueva",
            "image" => "face.jpg",
            "age" => 19,
            "birthday" => "2007-06-25",
            "contact" => "09261234567"
        )

    );

    usort($persons, function($a, $b){
        return strcmp($a['name'], $b['name']);
    });
    ?>

    <table>
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Image</th>
            <th>Age</th>
            <th>Birthday</th>
            <th>Cellphone Number</th>
        </tr>

        <?php
            $number = 1;

            foreach($persons as $person){
                echo "<tr>";
                echo "<td>".$number."</td>";
                echo "<td>".$person['name']."</td>";
                echo "<td><img src='".$person['image']."' alt='Person Image'></td>";
                echo "<td>".$person['age']."</td>";
                echo "<td>".$person['birthday']."</td>";
                echo "<td>".$person['contact']."</td>";
                echo "</tr>";

                $number++;
            }
        ?>

    </table>

</body>
</html>