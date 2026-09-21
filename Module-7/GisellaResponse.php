<?php
/*
    Name: Gisella Murcia
    Assignment: PHP Form
    Purpose: Validate and display the seven values submitted by the form.
*/

$errors = [];

// Make sure the page was opened by submitting the form.
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    $errors[] = "Please complete the form before opening this page.";
} else {
    // Get the values and remove extra spaces.
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $age = trim($_POST["age"] ?? "");
    $birthdate = trim($_POST["birthdate"] ?? "");
    $program = trim($_POST["program"] ?? "");
    $study = trim($_POST["study"] ?? "");
    $comments = trim($_POST["comments"] ?? "");

    // Check that every field contains valid information.
    if ($name === "" || !preg_match("/^[a-zA-ZÀ-ÿ .'-]+$/u", $name)) {
        $errors[] = "Please enter a valid name.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    if (filter_var($age, FILTER_VALIDATE_INT) === false || $age < 16 || $age > 100) {
        $errors[] = "Age must be a whole number from 16 to 100.";
    }

    $date = DateTime::createFromFormat("Y-m-d", $birthdate);
    if (!$date || $date->format("Y-m-d") !== $birthdate) {
        $errors[] = "Please enter a valid birth date.";
    }

    $validPrograms = ["Software Development", "Cybersecurity", "Business"];
    if (!in_array($program, $validPrograms, true)) {
        $errors[] = "Please select a valid program.";
    }

    if ($study !== "Online" && $study !== "On Campus") {
        $errors[] = "Please select a study preference.";
    }

    if ($comments === "") {
        $errors[] = "Please enter a reason for choosing the program.";
    }
}

// Protect the page when displaying information entered by the user.
function clean($value) {
    return htmlspecialchars($value, ENT_QUOTES, "UTF-8");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gisella Form Response</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef4f7;
            color: #333;
        }

        .result-box {
            width: 500px;
            margin: 40px auto;
            padding: 25px;
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        h1 {
            color: #28566f;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 9px;
            border: 1px solid #bbb;
            text-align: left;
        }

        th {
            width: 38%;
            background-color: #dcebf2;
        }

        .error {
            color: #a61b1b;
        }

        a {
            display: inline-block;
            margin-top: 18px;
            color: #28566f;
        }
    </style>
</head>
<body>
    <div class="result-box">
        <?php if (!empty($errors)) { ?>
            <h1>Form Error</h1>
            <p class="error">Please correct the following problem(s):</p>
            <ul>
                <?php foreach ($errors as $error) { ?>
                    <li><?php echo clean($error); ?></li>
                <?php } ?>
            </ul>
            <a href="GisellaForm.html">Return to the form</a>
        <?php } else { ?>
            <h1>Information Received</h1>
            <p>Thank you! Your form was submitted successfully.</p>

            <table>
                <tr><th>Full Name</th><td><?php echo clean($name); ?></td></tr>
                <tr><th>Email</th><td><?php echo clean($email); ?></td></tr>
                <tr><th>Age</th><td><?php echo clean($age); ?></td></tr>
                <tr><th>Birth Date</th><td><?php echo clean($birthdate); ?></td></tr>
                <tr><th>Program</th><td><?php echo clean($program); ?></td></tr>
                <tr><th>Study Preference</th><td><?php echo clean($study); ?></td></tr>
                <tr><th>Reason</th><td><?php echo nl2br(clean($comments)); ?></td></tr>
            </table>

            <a href="GisellaForm.html">Submit another response</a>
        <?php } ?>
    </div>
</body>
</html>
