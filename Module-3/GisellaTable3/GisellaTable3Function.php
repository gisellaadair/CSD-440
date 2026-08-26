<?php
/**
 * GisellaTable3Function.php
 *
 * Author: Gisella Adair
 * Date: August 25, 2026
 * Assignment: Module 3 - PHP Table Function
 * Purpose: Provides the external function used to calculate the value
 *          displayed in each cell of the random-number table.
 */

/**
 * Adds two integers and returns their sum.
 *
 * @param int $firstNumber  The first randomly generated number.
 * @param int $secondNumber The second randomly generated number.
 * @return int The sum of the two numbers.
 */
function calculateCellValue(int $firstNumber, int $secondNumber): int
{
    return $firstNumber + $secondNumber;
}

