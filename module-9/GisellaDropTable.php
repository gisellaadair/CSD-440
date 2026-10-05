<?php
/**
 * GisellaDropTable.php
 *
 * Removes the favorite_movies table from the assigned database.
 * IF EXISTS lets the script run even when the table has already been removed.
 */

$host = "localhost";
$username = "student1";
$password = "pass";
$database = "baseball_01";

$connection = new mysqli($host, $username, $password, $database);

if ($connection->connect_error) {
    die("Database connection failed: " . htmlspecialchars($connection->connect_error));
}

$sql = "DROP TABLE IF EXISTS favorite_movies";
$message = $connection->query($sql)
    ? "The favorite_movies table was dropped successfully."
    : "The table could not be dropped: " . $connection->error;

$connection->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drop Favorite Movies Table</title>
</head>
<body>
    <h1>Drop Favorite Movies Table</h1>
    <p><?php echo htmlspecialchars($message); ?></p>
</body>
</html>
