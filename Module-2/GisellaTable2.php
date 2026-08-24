<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gisella's Random Number Table</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f9;
            color: #1f2933;
            margin: 0;
            padding: 40px 20px;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            margin: 25px auto;
            background-color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        }

        th,
        td {
            border: 1px solid #526d82;
            height: 45px;
            width: 60px;
            text-align: center;
        }

        th {
            background-color: #27374d;
            color: #ffffff;
        }

        tr:nth-child(even) td {
            background-color: #eaf0f4;
        }
    </style>
</head>
<body>
    <h1>PHP Random Number Table</h1>
    <p>This 10-by-10 table contains PHP-generated random numbers from 1 to 100.</p>

    <!--
        Program: GisellaTable2.php
        Author: Gisella Adair
        Purpose: Demonstrate a PHP nested loop by generating random numbers
                 inside a two-dimensional HTML table.
    -->
    <table>
        <thead>
            <tr>
                <th colspan="10">Random Numbers</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // The outer loop creates the 10 table rows.
            for ($row = 1; $row <= 10; $row++) {
            ?>
                <tr>
                    <?php
                    // The inner loop creates 10 cells in each row.
                    for ($column = 1; $column <= 10; $column++) {
                        $randomNumber = rand(1, 100);
                    ?>
                        <td><?php echo $randomNumber; ?></td>
                    <?php
                    }
                    ?>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</body>
</html>
