<?php
/**
 * GisellaTable3.php
 *
 * Author: Gisella Adair
 * Date: August 25, 2026
 * Assignment: Module 3 - PHP Table Function
 * Purpose: Creates an HTML table with nested PHP loops. Each cell contains
 *          two random numbers and the sum returned by an external function.
 */

require_once 'GisellaTable3Function.php';

$numberOfRows = 5;
$numberOfColumns = 5;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gisella's Random Number Table</title>
    <style>
        body {
            background-color: #f4f7fb;
            color: #1f2937;
            font-family: Arial, sans-serif;
            margin: 40px;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            margin: 24px auto;
        }

        td {
            background-color: #ffffff;
            border: 1px solid #334155;
            padding: 16px;
            min-width: 100px;
        }

        tr:nth-child(even) td {
            background-color: #e8eef7;
        }
    </style>
</head>
<body>
    <header>
        <h1>Random Number Addition Table</h1>
        <p>Each cell shows two random numbers and the sum returned by the external function.</p>
    </header>

    <main>
        <table>
            <tbody>
                <?php for ($row = 1; $row <= $numberOfRows; $row++) { ?>
                    <tr>
                        <?php for ($column = 1; $column <= $numberOfColumns; $column++) { ?>
                            <?php
                            $firstRandomNumber = random_int(1, 100);
                            $secondRandomNumber = random_int(1, 100);
                            $sum = calculateCellValue($firstRandomNumber, $secondRandomNumber);
                            ?>
                            <td>
                                <?php echo $firstRandomNumber . ' + ' . $secondRandomNumber . ' = ' . $sum; ?>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>

    <footer>
        <p>Created by Gisella Adair &mdash; Module 3</p>
    </footer>
</body>
</html>

