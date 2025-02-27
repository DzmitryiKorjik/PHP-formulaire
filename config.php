<?php
require_once __DIR__ . '/vendor/autoload.php'; // Connexion Composer

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__); // Chargement .env
$dotenv->load();

// Vérifier si les variables sont chargées
if (!isset($_SERVER['DB_HOST']) || !isset($_SERVER['DB_NAME']) || 
    !isset($_SERVER['DB_USER']) || !isset($_SERVER['DB_PASSWORD'])) {
    die('Erreur : impossible de charger les variables .env');
}

// Utilise $_SERVER
$db_host = $_SERVER['DB_HOST'];
$db_name = $_SERVER['DB_NAME'];
$db_user = $_SERVER['DB_USER'];
$db_pass = $_SERVER['DB_PASSWORD'];

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>
