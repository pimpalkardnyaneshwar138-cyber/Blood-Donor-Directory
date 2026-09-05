<?php
// Database connection
// Replace these values with your InfinityFree MySQL credentials.
$host = "localhost";
$user = "YOUR_DB_USERNAME";
$password = "YOUR_DB_PASSWORD";
$database = "YOUR_DB_NAME";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    error_log("Database connection failed: " . mysqli_connect_error());
    die("Unable to connect to the database. Please try again later.");
}

mysqli_set_charset($conn, "utf8mb4");
?>