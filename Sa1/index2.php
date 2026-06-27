<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiplication Table</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            align-items: center;
            justify-content: center;
            text-align: center;
            background-color: #443e3e;
        }

        h1 {
            color: white;
            margin-top: 20px;
        }

        table{
            border-collapse: collapse;
            border: 3px solid #000000;
            margin: 0 auto;
        }

        td {
            border: 3px solid #000000;
            padding: 10px;
            text-align: center;
            font-size: 30px;
        }

        .even {
            color: #e2e2e2;
            background-color: #391B20;
        }

        .odd{
            color: #e2e2e2;
            background-color: #1C1B23;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Multiplication Table</h1>

        <table>
            <?php
                for ($row = 0; $row <= 10; $row++) {
                    echo "<tr>";
                    for ($col = 0; $col <= 10; $col++) {
                        $result = $row * $col;

                        if (($row + $col) % 2 == 0) {
                            $color = "even";
                        }
                        else {
                            $color = "odd";
                        }

                        echo "<td class = $color>" . $result . "</td>";
                    }
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>