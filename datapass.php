

<?php
// Replace 'your_database_name' with the actual database name
$dsn = 'mysql:host=localhost;dbname=shop';
$username = 'root'; // Correct username (lowercase)
$password = '';     // Default password is empty in XAMPP

try {
    $databass = new PDO($dsn, $username, $password);
    $databass->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Database connection successful!";
} catch (PDOException $e) {
    die("Error connecting to database: " . $e->getMessage());
}
?>
