<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Grade Ranking</title> 
    <style> 
        .card { 
            width: 500px; 
            background: white; 
            border-radius: 10px; 
            box-shadow: 0 4px 10px rgba(0,0,0,0.2); 
            padding: 20px; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
        } 

        .info { 
            text-align: left; 
        } 
 
        .info h2 { 
            margin: 0; 
        } 

        .info p { 
            margin: 8px 0; 
            font-size: 18px; 
        } 

        .photo img { 
            width: 120px; 
            height: 120px; 
            border-radius: 10px; 
            object-fit: cover; 
        } 
    </style> 
    <link rel="stylesheet" type="text/css" href="style.css">
</head> 

<body> 
    <div class="navigation">
            <ul class="nav_links">
                <a href="homepage.php"><li>Home</li></a>
                <a href="index_1.php"><li>Work 1</li></a>
                <a href="index_3.php"><li>Work 3</li></a>
            </ul>
    </div>
   <?php 
    $name = "Justin Czar E. Borines"; 
    $grade = 95; 

    if ($grade >= 93 && $grade <= 100) $rank = "A"; 
    elseif ($grade >= 90) $rank = "A-"; 
    elseif ($grade >= 87) $rank = "B+"; 
    elseif ($grade >= 83) $rank = "B"; 
    elseif ($grade >= 80) $rank = "B-"; 
    elseif ($grade >= 77) $rank = "C+"; 
    elseif ($grade >= 73) $rank = "C"; 
    elseif ($grade >= 70) $rank = "C-"; 
    elseif ($grade >= 67) $rank = "D+"; 
    elseif ($grade >= 63) $rank = "D"; 
    elseif ($grade >= 60) $rank = "D-"; 
    else $rank = "F"; 
    ?> 

    <div class="card"> 
        <div class="info"> 
            <h2><?php echo $name; ?></h2> 
            <p><strong>Grade:</strong> <?php echo $grade; ?></p> 
            <p><strong>Rank:</strong> <?php echo $rank; ?></p> 
        </div> 

        <div class="photo"> 
            <img src="Images/Smiley.png" alt="Student Photo"> 
        </div> 
    </div> 
</body> 
</html> 