<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array Computation</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Array Operations using PHP</h1>

    <?php
    $numbers = array(5, 10, 15, 20, 25, 30, 35, 40, 45, 50);

    $arrayValues = implode(", ", $numbers);

    // SUM
    $sum = array_sum($numbers);

    // DIFFERENCE
    $difference = $numbers[0];

    for($i = 1; $i < count($numbers); $i++){
        $difference -= $numbers[$i];
    }

    // PRODUCT
    $product = 1;

    foreach($numbers as $num){
        $product *= $num;
    }

    // QUOTIENT
    $quotient = $numbers[0];

    for($i = 1; $i < count($numbers); $i++){
        $quotient /= $numbers[$i];
    }

    ?>

    <table>
        <tr>
            <th colspan="2">
                Array Values: <?php echo $arrayValues; ?>
            </th>
        </tr>

        <tr>
            <td><b>Sum</b></td>
            <td><?php echo $sum; ?></td>
        </tr>

        <tr>
            <td><b>Difference</b></td>
            <td><?php echo $difference; ?></td>
        </tr>

        <tr>
            <td><b>Product</b></td>
            <td><?php echo $product; ?></td>
        </tr>

        <tr>
            <td><b>Quotient</b></td>
            <td><?php echo $quotient; ?></td>
        </tr>
    </table>

</body>
</html>