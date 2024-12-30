
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$dsn = 'mysql:host=sql112.infinityfree.com;dbname=';
$username = ''; // Correct username

$password = '';

try {
    $databass = new PDO($dsn, $username, $password);
    $databass->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Database connection successful!";
} catch (PDOException $e) {
    die("Error connecting to database: " . $e->getMessage());
}
?>
