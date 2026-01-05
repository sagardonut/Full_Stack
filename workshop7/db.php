<?php 

$server = 'localhost';
$username = 'np03cs4s250093';
$password = 'RyOonWURc7';
$database = 'np03cs4s250093';

try {
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ];

    $pdo = new PDO(
        "mysql:host=$server;dbname=$database;charset=utf8mb4",
        $username,
        $password,
        $options
    );

} catch (PDOException $e) {
    die("Connection Failed: " . $e->getMessage());
}

?>
