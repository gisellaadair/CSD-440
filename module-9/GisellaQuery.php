<?php
/** GisellaQuery.php: Searches favorite_movies using a bound LIKE parameter. */
function escapeHtml($value): string { return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
$term = trim((string)($_GET['term'] ?? ''));
$error = '';
$rows = [];
if (strlen($term) > 100) {
    $error = 'Search text must be 100 characters or fewer.';
} elseif ($term !== '') {
    try {
        $db = new mysqli('localhost', 'student1', 'pass', 'baseball_01');
        $db->set_charset('utf8mb4');
        // Treat the user's percent signs and underscores as literal search text.
        $literal = str_replace(['\\', '%', '_'], ['\\\\', '\\%', '\\_'], $term);
        $pattern = '%' . $literal . '%';
        $stmt = $db->prepare('SELECT movie_id, title, director, release_year, genre, personal_rating, date_watched FROM favorite_movies WHERE title LIKE ? OR director LIKE ? OR genre LIKE ? ORDER BY personal_rating DESC, title ASC');
        $stmt->bind_param('sss', $pattern, $pattern, $pattern);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $result->free(); $stmt->close(); $db->close();
    } catch (mysqli_sql_exception $exception) {
        error_log('GisellaQuery database error: ' . $exception->getMessage());
        $error = 'Search failed. Check that the database and favorite_movies table are available.';
    }
}
?>
<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Gisella Adair | Search Movies</title>
<style>body{font:16px/1.5 system-ui;margin:0;background:#f2f5fa;color:#24324b}header{background:#18385e;color:white;padding:1.5rem}main{max-width:900px;margin:2rem auto;padding:0 1rem}form,.panel{background:white;padding:1.2rem;border-radius:9px;margin:1rem 0;box-shadow:0 2px 12px #172b4d18}label{display:block;font-weight:650}input{padding:.65rem;font:inherit;max-width:100%;width:350px;border:1px solid #75829a;border-radius:5px}button{padding:.7rem 1.1rem;background:#135a98;color:white;border:0;border-radius:5px;font:inherit}a{color:#135a98}:focus-visible{outline:3px solid orange}.error{color:#a12030}.scroll{overflow-x:auto}table{border-collapse:collapse;width:100%}th,td{text-align:left;padding:.65rem;border-bottom:1px solid #ccd7e4}th{background:#e7eff8}</style></head>
<body><header><h1>Search Favorite Movies</h1></header><main><p><a href="GisellaIndex.php">Back to index</a> · <a href="GisellaForms.php">Add a movie</a></p>
<form method="get" action="GisellaQuery.php"><label for="term">Title, director, or genre</label><input id="term" name="term" type="search" maxlength="100" required value="<?= escapeHtml($term) ?>"> <button type="submit">Search</button></form>
<?php if ($error !== ''): ?><p class="error" role="alert"><?= escapeHtml($error) ?></p>
<?php elseif ($term !== ''): ?><section class="panel"><h2>Results for “<?= escapeHtml($term) ?>”</h2><p><?= count($rows) ?> movie(s) found.</p>
<?php if ($rows): ?><div class="scroll"><table><caption>Matching favorite movies</caption><thead><tr><th scope="col">ID</th><th scope="col">Title</th><th scope="col">Director</th><th scope="col">Year</th><th scope="col">Genre</th><th scope="col">Rating</th><th scope="col">Date watched</th></tr></thead><tbody>
<?php foreach ($rows as $row): ?><tr><td><?= escapeHtml($row['movie_id']) ?></td><td><?= escapeHtml($row['title']) ?></td><td><?= escapeHtml($row['director']) ?></td><td><?= escapeHtml($row['release_year']) ?></td><td><?= escapeHtml($row['genre']) ?></td><td><?= escapeHtml($row['personal_rating']) ?>/10</td><td><?= escapeHtml($row['date_watched'] ?? '—') ?></td></tr><?php endforeach; ?>
</tbody></table></div><?php endif; ?></section>
<?php else: ?><p>Enter a search term to find saved movies.</p><?php endif; ?>
</main></body></html>
