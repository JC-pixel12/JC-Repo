<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        h1 {
            text-align: center;
            padding: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000000;
            padding: 6px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>    
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php  
        $mm = 1;
        $cm = 1;
        $dc = 1;
        $m = 1;
        $km = 1;
        $in = 1;
        $ft = 1;
        $yd = 1;
        $chain = 1;
        $frl = 1;
        $mi = 1;
   
        function convert_m($value, $from_unit, $to_unit) {
            $units = [
                'mm' => 1,
                'cm' => 10,
                'dc' => 100,
                'm' => 1000,
                'km' => 1000000,
                'in' => 25.4,
                'ft' => 304.8,
                'yd' => 914.4,
                'chain' => 20116.8,
                'frl' => 2011680,
                'mi' => 1609344
            ];

            if (isset($units[$from_unit]) && isset($units[$to_unit])) {
                return ($value * $units[$from_unit]) / $units[$to_unit];
            } else {
                return "Invalid unit";
            }
        }
    ?>

    <div class="navigation">
        <ul class="nav_links">
            <a href="homepage.php"><li>Home</li></a>
            <a href="index_2.php"><li>Work 2</li></a>
            <a href="index_3.php"><li>Work 3</li></a>
        </ul>
    </div>

    <h1>MEASURE CONVERSION CHART - LENGTHS(UK)</h1>

    <table>
        <tr>
            <th></th>
            <th></th>
            <th><h3>Metric Conversion</h3></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <td><?php echo $cm . " centimetre" ?></td>
            <td> = </td>
            <td><?= convert_m($cm, 'cm', 'mm') . " millimetres" ?></td>
            <td><?php echo $cm . " cm" ?></td>
            <td> = </td>
            <td><?= convert_m($cm, 'cm', 'mm') . " mm" ?></td>
        </tr>
        <tr>
            <td><?php echo $dc . " decimetre" ?></td>
            <td> = </td>
            <td><?= convert_m($dc, 'dc', 'cm') . " centimetres" ?></td>
            <td><?php echo $dc . " dm" ?></td>
            <td> = </td>
            <td><?= convert_m($dc, 'dc', 'cm') . " cm" ?></td>
        </tr>
        <tr>
            <td><?php echo $m . " metre" ?></td>
            <td> = </td>
            <td><?= convert_m($m, 'm', 'cm') . " centimetres" ?></td>
            <td><?php echo $m . " m" ?></td>
            <td> = </td>
            <td><?= convert_m($m, 'm', 'cm') . " cm" ?></td>
        </tr>
        <tr>
            <td><?php echo $km . " kilometre" ?></td>
            <td> = </td>
            <td><?= convert_m($km, 'km', 'm') . " metres" ?></td>
            <td><?php echo $km . " km" ?></td>
            <td> = </td>
            <td><?= convert_m($km, 'km', 'm') . " m" ?></td>
        </tr>
    </table>
    
    <br/>

    <table>
        <tr>
            <th></th>
            <th></th>
            <th><h3>Imperial Conversion</h3></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <td><?php echo $ft . " foot" ?></td>
            <td> = </td>
            <td><?= convert_m($ft, 'ft', 'in') . " inches" ?></td>
            <td><?php echo $ft . " ft" ?></td>
            <td> = </td>
            <td><?= convert_m($ft, 'ft', 'in') . " in" ?></td>
        </tr>
        <tr>
            <td><?php echo $yd . " yard" ?></td>
            <td> = </td>
            <td><?= convert_m($yd, 'yd', 'ft') . " feet" ?></td>
            <td><?php echo $yd . " yd" ?></td>
            <td> = </td>
            <td><?= convert_m($yd, 'yd', 'ft') . " ft" ?></td>
        </tr>
        <tr>
            <td><?php echo $chain . " chain" ?></td>
            <td> = </td>
            <td><?= convert_m($chain, 'chain', 'yd') . " yards" ?></td>
            <td><?php echo $chain . " ch" ?></td>
            <td> = </td>
            <td><?= convert_m($chain, 'chain', 'yd') . " yd" ?></td>
        </tr>
        <tr>
            <td><?php echo $frl . " furlong" ?></td>
            <td> = </td>
            <td><?= convert_m($frl, 'frl', 'chain') . " chains" ?></td>
            <td><?php echo $frl . " frl" ?></td>
            <td> = </td>
            <td><?= convert_m($frl, 'frl', 'chain') . " ch" ?></td>
        </tr>
        <tr>
            <td><?php echo $mi . " mile" ?></td>
            <td> = </td>
            <td><?= convert_m($mi, 'mi', 'yd') . " yards" ?></td>
            <td><?php echo $mi . " mi" ?></td>
            <td> = </td>
            <td><?= convert_m($mi, 'mi', 'yd') . " yd" ?></td>
        </tr>
    </table>

    <br/>

    <table>
        <tr>
            <th></th>
            <th></th>
            <th><h3>METRIC -> IMPERIAL CONVERSION</h3></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <td><?php echo $mm . " millimetre" ?></td>
            <td> = </td>
            <td><?= convert_m($mm, 'mm', 'in') . " inches" ?></td>
            <td><?php echo $mm . " mm" ?></td>
            <td> = </td>
            <td><?= convert_m($mm, 'mm', 'in') . " in" ?></td>
        </tr>
        <tr>
            <td><?php echo $cm . " centimetre" ?></td>
            <td> = </td>
            <td><?= convert_m($cm, 'cm', 'in') . " inches" ?></td>
            <td><?php echo $cm . " cm" ?></td>
            <td> = </td>
            <td><?= convert_m($cm, 'cm', 'in') . " in" ?></td>
        </tr>
        <tr>
            <td><?php echo $m . " metre" ?></td>
            <td> = </td>
            <td><?= convert_m($m, 'm', 'in') . " inches" ?></td>
            <td><?php echo $m . " m" ?></td>
            <td> = </td>
            <td><?= convert_m($m, 'm', 'in') . " in" ?></td>
        </tr>
        <tr>
            <td><?php echo $m . " metre" ?></td>
            <td> = </td>
            <td><?= convert_m($m, 'm', 'ft') . " feet" ?></td>
            <td><?php echo $m . " m" ?></td>
            <td> = </td>
            <td><?= convert_m($m, 'm', 'ft') . " ft" ?></td>
        </tr>
        <tr>
            <td><?php echo $m . " metre" ?></td>
            <td> = </td>
            <td><?= convert_m($m, 'm', 'yd') . " yards" ?></td>
            <td><?php echo $m . " m" ?></td>
            <td> = </td>
            <td><?= convert_m($m, 'm', 'yd') . " yd" ?></td>
        </tr>
        <tr>
            <td><?php echo $km . " kilometre" ?></td>
            <td> = </td>
            <td><?= convert_m($km, 'km', 'yd') . " yards" ?></td>
            <td><?php echo $km . " km" ?></td>
            <td> = </td>
            <td><?= convert_m($km, 'km', 'yd') . " yd" ?></td>
        </tr>
        <tr>
            <td><?php echo $km . " kilometre" ?></td>
            <td> = </td>
            <td><?= convert_m($km, 'km', 'mi') . " miles" ?></td>
            <td><?php echo $km . " km" ?></td>
            <td> = </td>
            <td><?= convert_m($km, 'km', 'mi') . " mi" ?></td>
        </tr>
    </table>

    <br/>

    <table>
        <tr>
            <th></th>
            <th></th>
            <th><h3>IMPERIAL -> METRIC CONVERSION</h3></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <td><?php echo $in . " inch" ?></td>
            <td> = </td>
            <td><?= convert_m($in, 'in', 'cm') . " centimetres" ?></td>
            <td><?php echo $in . " in" ?></td>
            <td> = </td>
            <td><?= convert_m($in, 'in', 'cm') . " cm" ?></td>
        </tr>
        <tr>
            <td><?php echo $ft . " foot" ?></td>
            <td> = </td>
            <td><?= convert_m($ft, 'ft', 'cm') . " centimetres" ?></td>
            <td><?php echo $ft . " ft" ?></td>
            <td> = </td>
            <td><?= convert_m($ft, 'ft', 'cm') . " cm" ?></td>
        </tr>
        <tr>
            <td><?php echo $yd . " yard" ?></td>
            <td> = </td>
            <td><?= convert_m($yd, 'yd', 'cm') . " centimetres" ?></td>
            <td><?php echo $yd . " yd" ?></td>
            <td> = </td>
            <td><?= convert_m($yd, 'yd', 'cm') . " cm" ?></td>
        </tr>
        <tr>
            <td><?php echo $yd . " yard" ?></td>
            <td> = </td>
            <td><?= convert_m($yd, 'yd', 'm') . " metres" ?></td>
            <td><?php echo $yd . " yard" ?></td>
            <td> = </td>
            <td><?= convert_m($yd, 'yd', 'm') . " m" ?></td>
        </tr>
        <tr>
            <td><?php echo $mi . " mile" ?></td>
            <td> = </td>
            <td><?= convert_m($mi, 'mi', 'm') . " metres" ?></td>
            <td><?php echo $mi . " mi" ?></td>
            <td> = </td>
            <td><?= convert_m($mi, 'mi', 'm') . " m" ?></td>
        </tr>
        <tr>
            <td><?php echo $mi . " mile" ?></td>
            <td> = </td>
            <td><?= convert_m($mi, 'mi', 'km') . " kilometres" ?></td>
            <td><?php echo $mi . " mi" ?></td>
            <td> = </td>
            <td><?= convert_m($mi, 'mi', 'km') . " km" ?></td>
        </tr>
    </table>
</body>
</html>
       