
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$dsn = 'mysql:host=sql112.infinityfree.com;dbname=if0_38009419_shop';
$username = 'if0_38009419'; // Correct username
$username = 'if0_38009419';
$password = 'Ah0540919725';

try {
    $databass = new PDO($dsn, $username, $password);
    $databass->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Database connection successful!";
} catch (PDOException $e) {
    die("Error connecting to database: " . $e->getMessage());
}
?>
