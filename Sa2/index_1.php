<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fruit Directory</title>

    <style>
        .img{
            width: 150px;
            height: 150px;
            padding: 0;
        }
    </style>

    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Fruit Directory</h1>

    <?php
    $names = array(
        array(
            "link" => "https://upload.wikimedia.org/wikipedia/commons/thumb/1/15/Red_Apple.jpg/120px-Red_Apple.jpg",
            "name" => "apple",
            "description" => "A sweet, edible fruit produced by an apple tree.",
            "facts" => "Apples are rich in fiber and vitamin C."
        ),
        array(
            "link" => "https://upload.wikimedia.org/wikipedia/commons/thumb/3/36/Kyoho-grape.jpg/120px-Kyoho-grape.jpg",
            "name" => "grape",
            "description" => "A small, sweet fruit that grows in clusters on vines.",
            "facts" => "Grapes can be eaten fresh or used to make wine."
        ),
        array(
            "link" => "https://pamsdailydish.com/wp-content/uploads/2015/04/Bunch-Bananas-1.jpg",
            "name" => "banana",
            "description" => "A long, curved fruit with a yellow skin and soft, sweet flesh.",
            "facts" => "Bananas are a good source of potassium."
        ),
        array(
            "link" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRzuu9QPFmtFMGK4sMLqZ89vrwnWdO9ADmX6w&s",
            "name" => "strawberry",
            "description" => "A red, juicy fruit with tiny seeds on its surface.",
            "facts" => "Strawberries are high in antioxidants and vitamin C."
        ),
        array(
            "link" => "https://www.quanta.org/orange/orange.jpg",
            "name" => "orange",
            "description" => "A round, orange fruit with a tough skin and juicy interior.",
            "facts" => "Oranges are an excellent source of vitamin C."
        ),
        array(
            "link" => "https://www.dole.com/sites/default/files/styles/1024w768h-80/public/media/2025-01/pineaple.png?itok=6P-hraWo-o1Nbx-ho",
            "name" => "pineapple",
            "description" => "A tropical fruit with a spiky exterior and sweet, tangy flesh.",
            "facts" => "Pineapples contain bromelain, an enzyme that aids digestion."
        ),
        array(
            "link" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQhTn9mIiFqW_tqIhD1fi5nLBV--vF1fGLrEQ&s",
            "name" => "watermelon",
            "description" => "A large, round fruit with a green rind and sweet, juicy red flesh.",
            "facts" => "Watermelons are about 92% water."
        ),
        array(
            "link" => "https://www.veggipedia.nl/_next/image?url=https%3A%2F%2Fveggipedia-cms.production.taks.zooma.cloud%2Fassets%2FUploads%2FProducts%2Fmango-fruit-veggipedia__FitMaxWzYwMCw2MDBd.png&w=3840&q=75",
            "name" => "mango",
            "description" => "A tropical fruit with a sweet, juicy flesh and a large seed in the center.",
            "facts" => "Mangoes are rich in vitamins A and C."
        ),
        array(
            "link" => "https://static.wikia.nocookie.net/fruit/images/0/03/Peachzdfgad.jpg/revision/latest?cb=20150621132645",
            "name" => "peach",
            "description" => "A round fruit with a fuzzy skin and sweet, juicy flesh.",
            "facts" => "Peaches are a good source of vitamins A and C."
        ),
        array(
            "link" => "https://www.veggipedia.nl/_next/image?url=https%3A%2F%2Fveggipedia-cms.production.taks.zooma.cloud%2Fassets%2FUploads%2FProducts%2FKersen-fruit-Veggipedia__FitMaxWzYwMCw2MDBd.png&w=3840&q=75",
            "name" => "cherry",
            "description" => "A small, round fruit with a red or black skin and a pit in the center.",
            "facts" => "Cherries are rich in antioxidants and anti-inflammatory compounds."
        )
    );

    usort($names, function($a, $b){
        return strcmp($a['name'], $b['name']);
    });
    
    ?>

    <table>
        <tr>
            <th colspan="4">My Fruits</th>
        </tr>

        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Description</th>
            <th>Facts</th>
        </tr>

        <?php
        foreach($names as $name){

            echo "<tr>";
            echo "<td class='img'><img src='{$name['link']}' alt='{$name['name']}' width='150'></td>";
            echo "<td>{$name['name']}</td>";
            echo "<td>{$name['description']}</td>";
            echo "<td>{$name['facts']}</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>