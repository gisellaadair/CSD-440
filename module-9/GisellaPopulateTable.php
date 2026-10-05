<?php
/**
 * GisellaPopulateTable.php
 *
 * Adds a small collection of favorite movies to the favorite_movies table.
 * A prepared statement is used so the values are handled safely by MySQL.
 */

$host = "localhost";
$username = "student1";
$password = "pass";
$database = "baseball_01";

$connection = new mysqli($host, $username, $password, $database);

if ($connection->connect_error) {
    die("Database connection failed: " . htmlspecialchars($connection->connect_error));
}

$movies = [
    ["Spirited Away", "Hayao Miyazaki", 2001, "Animation", 9.5, "2024-01-12"],
    ["The Truman Show", "Peter Weir", 1998, "Comedy-Drama", 9.0, "2024-02-03"],
    ["Arrival", "Denis Villeneuve", 2016, "Science Fiction", 9.2, "2024-03-16"],
    ["Knives Out", "Rian Johnson", 2019, "Mystery", 8.8, "2024-04-20"],
    ["The Grand Budapest Hotel", "Wes Anderson", 2014, "Comedy", 8.7, "2024-05-11"]
];

$sql = "INSERT INTO favorite_movies
        (title, director, release_year, genre, personal_rating, date_watched)
        VALUES (?, ?, ?, ?, ?, ?)";
$statement = $connection->prepare($sql);
$message = "";

if (!$statement) {
    $message = "The insert statement could not be prepared: " . $connection->error;
} else {
    $connection->begin_transaction();

    try {
        foreach ($movies as $movie) {
            [$title, $director, $year, $genre, $rating, $watched] = $movie;
            $statement->bind_param("ssisds", $title, $director, $year, $genre, $rating, $watched);
            $statement->execute();
        }

        $connection->commit();
        $message = count($movies) . " movies were added successfully.";
    } catch (mysqli_sql_exception $exception) {
        $connection->rollback();
        $message = "The movies could not be added: " . $exception->getMessage();
    }

    $statement->close();
}

$connection->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Populate Favorite Movies Table</title>
</head>
<body>
    <h1>Populate Favorite Movies Table</h1>
    <p><?php echo htmlspecialchars($message); ?></p>
    <p>Run the query script next to see the saved records.</p>
</body>
</html>
