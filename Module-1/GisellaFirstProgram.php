<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gisella's First PHP Program</title>
</head>

<body>
    <header>
        <h1>Welcome to My First PHP Program</h1>
    </header>

    <main>
        <h2>Student Information</h2>

        <?php

        $studentName = "Gisella Adair";
        $program = "Software Engineering";

        echo "<p><strong>Student:</strong> $studentName</p>";
        echo "<p><strong>Program:</strong> $program</p>";
        ?>

        <h2>PHP Calculation</h2>

        <?php
        // Calculate the sum of two numbers
        $firstNumber = 15;
        $secondNumber = 10;
        $total = $firstNumber + $secondNumber;

        echo "<p>$firstNumber + $secondNumber = $total</p>";
        echo "<p>The PHP program is functioning correctly!</p>";
        ?>
    </main>

    <footer>
        <p>Created by Gisella Adair</p>
    </footer>
</body>
</html>