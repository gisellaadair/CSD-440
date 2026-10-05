<?php
/**
 * GisellaCreateTable.php
 *
 * Creates the favorite_movies table for the Module 8 database assignment.
 * Database: baseball_01
 */

$host = "localhost";
$username = "student1";
$password = "pass";
$database = "baseball_01";

// Connect to MySQL and select the assigned database.
$connection = new mysqli($host, $username, $password, $database);

if ($connection->connect_error) {
    die("Database connection failed: " . htmlspecialchars($connection->connect_error));
}

// The table includes text, whole-number, decimal, year, and date values.
$sql = "CREATE TABLE IF NOT EXISTS favorite_movies (
    movie_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    director VARCHAR(100) NOT NULL,
    release_year YEAR NOT NULL,
    genre VARCHAR(50) NOT NULL,
    personal_rating DECIMAL(3,1) NOT NULL,
    date_watched DATE NULL
)";

$message = $connection->query($sql)
    ? "The favorite_movies table was created successfully."
    : "The table could not be created: " . $connection->error;

$connection->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Favorite Movies Table</title>
</head>
<body>
    <h1>Create Favorite Movies Table</h1>
    <p><?php echo htmlspecialchars($message); ?></p>
</body>
</html>
