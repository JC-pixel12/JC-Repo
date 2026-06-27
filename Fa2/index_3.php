<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="navigation">
            <ul class="nav_links">
                <a href="homepage.php"><li>Home</li></a>
                <a href="index_1.php"><li>Work 1</li></a>
                <a href="index_2.php"><li>Work 2</li></a>
            </ul>
    </div>
    <?php 
        for ($i = 0; $i < 100; $i++) {
            if ($i < 10) {
                echo "0". $i . ", ";
            }    
            else {
                echo $i . ", ";
            }
        }
    ?>
</body>
</html>