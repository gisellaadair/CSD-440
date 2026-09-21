<?php
/**
 * GisellaQueryTable.php
 *
 * Reads every record from favorite_movies and displays the results in an
 * HTML table. Results are ordered from the highest personal rating downward.
 */

$host = "localhost";
$username = "student1";
$password = "pass";
$database = "baseball_01";

$connection = new mysqli($host, $username, $password, $database);

if ($connection->connect_error) {
    die("Database connection failed: " . htmlspecialchars($connection->connect_error));
}

$sql = "SELECT movie_id, title, director, release_year, genre,
               personal_rating, date_watched
        FROM favorite_movies
        ORDER BY personal_rating DESC, title ASC";
$result = $connection->query($sql);
$queryError = $result ? "" : $connection->error;

// Short helper keeps all database text safe when it is placed in the page.
function displayValue($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, "UTF-8");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorite Movies</title>
</head>
<body>
    <h1>My Favorite Movies</h1>

    <?php if ($queryError !== ""): ?>
        <p><?php echo displayValue("The query failed: " . $queryError); ?></p>
    <?php elseif ($result->num_rows === 0): ?>
        <p>No movies were found. Run the populate script first.</p>
    <?php else: ?>
        <p><?php echo $result->num_rows; ?> movie records were found.</p>
        <table border="1">
            <caption>Favorite movies ordered by personal rating</caption>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Director</th>
                    <th>Year</th>
                    <th>Genre</th>
                    <th>Rating</th>
                    <th>Date Watched</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo displayValue($row["movie_id"]); ?></td>
                        <td><?php echo displayValue($row["title"]); ?></td>
                        <td><?php echo displayValue($row["director"]); ?></td>
                        <td><?php echo displayValue($row["release_year"]); ?></td>
                        <td><?php echo displayValue($row["genre"]); ?></td>
                        <td><?php echo displayValue($row["personal_rating"]); ?>/10</td>
                        <td><?php echo displayValue($row["date_watched"]); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>
<?php
if ($result) {
    $result->free();
}
$connection->close();
?>
