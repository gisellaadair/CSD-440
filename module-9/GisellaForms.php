<?php
/**
 * GisellaForms.php: Validate and insert one favorite_movies record.
 * The POST form uses a prepared MySQLi statement; output is HTML-escaped.
 */
function escapeHtml($value): string { return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
$fields = ['title' => '', 'director' => '', 'release_year' => '', 'genre' => '', 'personal_rating' => '', 'date_watched' => ''];
$errors = [];
$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($fields as $name => $_) {
        $fields[$name] = trim((string)($_POST[$name] ?? ''));
    }
    foreach (['title' => 100, 'director' => 100, 'genre' => 50] as $name => $limit) {
        if ($fields[$name] === '' || strlen($fields[$name]) > $limit) {
            $errors[] = ucfirst($name) . " is required and must be $limit characters or fewer.";
        }
    }
    $year = filter_var($fields['release_year'], FILTER_VALIDATE_INT);
    if ($year === false || $year < 1901 || $year > 2155) {
        $errors[] = 'Release year must be between 1901 and 2155 (the MySQL YEAR range).';
    }
    $rating = filter_var($fields['personal_rating'], FILTER_VALIDATE_FLOAT);
    if ($rating === false || !preg_match('/^(?:[0-9](?:\.[0-9])?|10(?:\.0)?)$/', $fields['personal_rating'])) {
        $errors[] = 'Rating must be between 0.0 and 10.0 with at most one decimal place.';
    }
    $watched = $fields['date_watched'];
    if ($watched !== '') {
        $date = DateTimeImmutable::createFromFormat('!Y-m-d', $watched);
        if (!$date || $date->format('Y-m-d') !== $watched) {
            $errors[] = 'Date watched must be a valid date in YYYY-MM-DD format.';
        }
    }
    if (!$errors) {
        try {
            $db = new mysqli('localhost', 'student1', 'pass', 'baseball_01');
            $db->set_charset('utf8mb4');
            $stmt = $db->prepare('INSERT INTO favorite_movies (title, director, release_year, genre, personal_rating, date_watched) VALUES (?, ?, ?, ?, ?, ?)');
            $dateValue = $watched === '' ? null : $watched;
            $stmt->bind_param('ssisds', $fields['title'], $fields['director'], $year, $fields['genre'], $rating, $dateValue);
            $stmt->execute();
            $insertedId = $db->insert_id;
            $stmt->close(); $db->close();
            $success = "Movie saved successfully (ID $insertedId).";
            $fields = array_fill_keys(array_keys($fields), '');
        } catch (mysqli_sql_exception $exception) {
            error_log('GisellaForms database error: ' . $exception->getMessage());
            $errors[] = 'Movie could not be saved. Check that the database and favorite_movies table are available.';
        }
    }
}
?>
<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Gisella Adair | Add Movie</title>
<style>body{font:16px/1.5 system-ui;margin:0;background:#f2f5fa;color:#24324b}header{background:#18385e;color:white;padding:1.5rem}main{max-width:720px;margin:2rem auto;padding:0 1rem}form{background:white;padding:1.5rem;border-radius:9px;box-shadow:0 2px 12px #172b4d18}label{display:block;font-weight:650;margin-top:1rem}input{display:block;box-sizing:border-box;width:100%;padding:.65rem;font:inherit;border:1px solid #75829a;border-radius:5px}button{margin-top:1.5rem;padding:.7rem 1.2rem;background:#135a98;color:white;border:0;border-radius:5px;font:inherit;cursor:pointer}a{color:#135a98}:focus-visible{outline:3px solid orange}.error{background:#fff0f0;color:#8b1525;padding:1rem}.success{background:#e5f5e9;color:#18512d;padding:1rem}</style></head>
<body><header><h1>Add a Favorite Movie</h1></header><main><p><a href="GisellaIndex.php">Back to index</a> · <a href="GisellaQuery.php">Search movies</a></p>
<?php if ($errors): ?><div class="error" role="alert"><strong>Please fix these errors:</strong><ul><?php foreach ($errors as $error): ?><li><?= escapeHtml($error) ?></li><?php endforeach; ?></ul></div><?php endif; ?>
<?php if ($success !== ''): ?><p class="success" role="status"><?= escapeHtml($success) ?></p><?php endif; ?>
<form method="post" action="GisellaForms.php">
<label for="title">Title *</label><input id="title" name="title" maxlength="100" required value="<?= escapeHtml($fields['title']) ?>">
<label for="director">Director *</label><input id="director" name="director" maxlength="100" required value="<?= escapeHtml($fields['director']) ?>">
<label for="release_year">Release year *</label><input id="release_year" name="release_year" type="number" min="1901" max="2155" required value="<?= escapeHtml($fields['release_year']) ?>">
<label for="genre">Genre *</label><input id="genre" name="genre" maxlength="50" required value="<?= escapeHtml($fields['genre']) ?>">
<label for="personal_rating">Personal rating (0.0–10.0) *</label><input id="personal_rating" name="personal_rating" type="number" min="0" max="10" step="0.1" required value="<?= escapeHtml($fields['personal_rating']) ?>">
<label for="date_watched">Date watched (optional)</label><input id="date_watched" name="date_watched" type="date" value="<?= escapeHtml($fields['date_watched']) ?>">
<button type="submit">Save movie</button></form></main></body></html>
