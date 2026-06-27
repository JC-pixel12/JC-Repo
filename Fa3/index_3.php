<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Defined Function in PHP</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>User Defined Function Operations</h1>

    <?php
        $numbers = array(40, 45, 50);

        $arrayValues = implode(", ", $numbers);

        function computeValues($array, $use){

            // SUM
            if($use == "sum"){
                return $sum = array_sum($array);
            }

            // DIFFERENCE
            if($use == "difference"){
                $difference = $array[0];
                
                for($i = 1; $i < count($array); $i++){
                    $difference -= $array[$i];
                }
                return $difference;
            }

            // PRODUCT
            if($use == "product"){
                $product = 1;

                foreach($array as $num){
                    $product *= $num;
                }
                return $product;
            }

            // QUOTIENT
            if($use == "quotient"){
                $quotient = $array[0];

                for($i = 1; $i < count($array); $i++){
                    $quotient /= $array[$i];
                }
                return $quotient;
            }
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
            <td><?php echo computeValues($numbers, "sum"); ?></td>
        </tr>

        <tr>
            <td><b>Difference</b></td>
            <td><?php echo computeValues($numbers, "difference"); ?></td>
        </tr>

        <tr>
            <td><b>Product</b></td>
            <td><?php echo computeValues($numbers, "product"); ?></td>
        </tr>

        <tr>
            <td><b>Quotient</b></td>
            <td><?php echo computeValues($numbers, "quotient"); ?></td>
        </tr>
    </table>
</body>
</html>