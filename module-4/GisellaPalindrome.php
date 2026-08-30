<?php
/**
 * File: GisellaPalindrome.php
 * Author: Gisella Adair
 * Date: August 24, 2026
 * Assignment: Palindrome Program
 * Purpose: Tests six strings to determine whether they read the same
 *          forward and backward.
 */

/**
 * Tests whether a string is a palindrome.
 *
 * The function converts the string to lowercase and removes spaces and
 * punctuation before comparing it with its reversed version.
 *
 * @param string $text The string to test.
 * @return bool True when the string is a palindrome; otherwise, false.
 */
function isPalindrome(string $text): bool
{
    $cleanText = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $text));
    return $cleanText === strrev($cleanText);
}

// Three palindrome examples and three non-palindrome examples.
$examples = [
    "racecar",
    "level",
    "civic",
    "computer",
    "website",
    "programming"
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Palindrome Test</title>
    <style>
        body {
            background-color: #f4f7fb;
            color: #243447;
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        main {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.12);
            margin: auto;
            max-width: 850px;
            padding: 30px;
        }

        h1 {
            color: #174a7e;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            margin-top: 25px;
            width: 100%;
        }

        th, td {
            border: 1px solid #b8c4d1;
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #174a7e;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #edf3f8;
        }

        .yes {
            color: #16723b;
            font-weight: bold;
        }

        .no {
            color: #b3261e;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <main>
        <h1>Palindrome Test Results</h1>
        <p>
            A palindrome is a string that reads the same forward and backward.
            The table below displays six strings and the result returned by the
            <code>isPalindrome()</code> function.
        </p>

        <table>
            <thead>
                <tr>
                    <th>Original String</th>
                    <th>String Reversed</th>
                    <th>Test Result</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($examples as $example) { ?>
                    <?php $palindrome = isPalindrome($example); ?>
                    <tr>
                        <td><?php echo htmlspecialchars($example); ?></td>
                        <td><?php echo htmlspecialchars(strrev($example)); ?></td>
                        <td class="<?php echo $palindrome ? 'yes' : 'no'; ?>">
                            <?php
                            echo $palindrome
                                ? "Yes, this string is a palindrome."
                                : "No, this string is not a palindrome.";
                            ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
</body>
</html>
