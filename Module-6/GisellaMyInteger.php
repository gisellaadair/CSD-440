<?php
/*
    Gisella Adair
    CSD 440
    MyInteger Assignment
*/

class GisellaMyInteger
{
    private $number;

    public function __construct($number)
    {
        $this->number = $number;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function setNumber($number)
    {
        $this->number = $number;
    }

    public function isEven($number)
    {
        return $number % 2 == 0;
    }

    public function isOdd($number)
    {
        return $number % 2 != 0;
    }

    public function isPrime()
    {
        if ($this->number < 2) {
            return false;
        }

        for ($i = 2; $i < $this->number; $i++) {
            if ($this->number % $i == 0) {
                return false;
            }
        }

        return true;
    }
}

// Create two objects
$number1 = new GisellaMyInteger(7);
$number2 = new GisellaMyInteger(10);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MyInteger Test</title>
</head>
<body>
    <h1>MyInteger Test</h1>

    <h2>First Object</h2>
    <p>Number: <?php echo $number1->getNumber(); ?></p>
    <p>Even: <?php echo $number1->isEven(7) ? "Yes" : "No"; ?></p>
    <p>Odd: <?php echo $number1->isOdd(7) ? "Yes" : "No"; ?></p>
    <p>Prime: <?php echo $number1->isPrime() ? "Yes" : "No"; ?></p>

    <h2>Second Object</h2>
    <p>Number: <?php echo $number2->getNumber(); ?></p>
    <p>Even: <?php echo $number2->isEven(10) ? "Yes" : "No"; ?></p>
    <p>Odd: <?php echo $number2->isOdd(10) ? "Yes" : "No"; ?></p>
    <p>Prime: <?php echo $number2->isPrime() ? "Yes" : "No"; ?></p>

    <?php $number2->setNumber(11); ?>
    <h2>Setter Test</h2>
    <p>New number: <?php echo $number2->getNumber(); ?></p>
</body>
</html>
