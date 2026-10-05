<?php
/*
 * File: Elvia JSON.php
 * Author: Elvia
 * Date: October 4, 2026
 * Purpose: Collect eight fields, validate them, and display formatted JSON.
 * Input: First name, last name, email, age, city, state, major, and hobby.
 * Output: A JSON result or an error list.
 * Run: Place this file on a PHP-enabled server and open it in a browser.
 */

// Escape text before displaying it in HTML.
function escapeHtml($text)
{
    return htmlspecialchars($text, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

$fields = [
    'first_name' => 'First Name',
    'last_name' => 'Last Name',
    'email' => 'Email',
    'age' => 'Age',
    'city' => 'City',
    'state' => 'State',
    'major' => 'Major',
    'hobby' => 'Favorite Hobby'
];
$values = array_fill_keys(array_keys($fields), '');
$errors = [];
$json = null;

// The same PHP file displays the form and processes its POST submission.
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    foreach ($fields as $name => $label) {
        $input = $_POST[$name] ?? '';
        if (!is_string($input)) {
            $errors[] = "$label must be a single value.";
            continue;
        }
        $values[$name] = trim($input);
        if ($values[$name] === '') {
            $errors[] = "$label is required.";
        } elseif (strlen($values[$name]) > 200) {
            $errors[] = "$label must be 200 bytes or fewer.";
        }
    }

    // Validate the email and age on the server, even if browser checks are bypassed.
    if ($values['email'] !== '' &&
        filter_var($values['email'], FILTER_VALIDATE_EMAIL) === false) {
        $errors[] = 'Enter a valid email address.';
    }
    $age = filter_var($values['age'], FILTER_VALIDATE_INT,
        ['options' => ['min_range' => 1, 'max_range' => 120]]);
    if ($values['age'] !== '' && $age === false) {
        $errors[] = 'Age must be a whole number from 1 to 120.';
    }

    if (empty($errors)) {
        $data = $values;
        $data['age'] = $age; // Store age as a JSON number.
        $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        if ($json === false) {
            $errors[] = 'JSON encoding failed: ' . json_last_error_msg();
            $json = null;
        }
    }
    if (!empty($errors)) {
        http_response_code(400);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Elvia's JSON Form</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #eef2f6; color: #243447; margin: 0; padding: 24px; }
        main { max-width: 700px; margin: auto; background: white; padding: 28px; border-radius: 10px; }
        h1 { margin-top: 0; }
        label { display: block; font-weight: bold; margin-top: 16px; }
        input { width: 100%; padding: 10px; margin-top: 6px; border: 1px solid #8796a5; border-radius: 4px; font: inherit; }
        button { margin-top: 22px; padding: 12px 20px; border: 0; border-radius: 4px; background: #215f99; color: white; font: inherit; cursor: pointer; }
        .result { margin-top: 24px; padding: 18px; background: #eaf5ee; border-left: 5px solid #2d7a45; }
        .error { margin-top: 24px; padding: 18px; background: #fff0f0; border-left: 5px solid #b32d2d; }
        h2 { margin-top: 0; }
        pre { padding: 16px; background: #162535; color: #f4f8fc; border-radius: 4px; white-space: pre-wrap; overflow-wrap: anywhere; }
    </style>
</head>
<body>
<main>
    <h1>Elvia's JSON Form</h1>
    <p>Complete all eight fields, then select Submit to view your data as JSON.</p>

    <?php if (!empty($errors)): ?>
        <section class="error" role="alert">
            <h2>Please correct the following problems</h2>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= escapeHtml($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </section>
    <?php elseif ($json !== null): ?>
        <section class="result" aria-live="polite">
            <h2>JSON Output</h2>
            <p>Your form was submitted successfully.</p>
            <pre><?= escapeHtml($json) ?></pre>
        </section>
    <?php endif; ?>

    <!-- An omitted action submits to this page, including on a PHP CGI server. -->
    <form method="post">
        <?php foreach ($fields as $name => $label): ?>
            <label for="<?= escapeHtml($name) ?>"><?= escapeHtml($label) ?></label>
            <input id="<?= escapeHtml($name) ?>" name="<?= escapeHtml($name) ?>"
                type="<?= $name === 'email' ? 'email' : ($name === 'age' ? 'number' : 'text') ?>"
                value="<?= escapeHtml($values[$name]) ?>"
                <?= $name === 'age' ? 'min="1" max="120" step="1"' : 'maxlength="200"' ?> required>
        <?php endforeach; ?>
        <button type="submit">Submit</button>
    </form>
</main>
</body>
</html>
