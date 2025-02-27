<?php
require_once __DIR__ . '/vendor/autoload.php'; // Connexion Composer

class Database {
    private static ?PDO $pdo = null;

    public static function connect(): PDO {
        if (is_null(self::$pdo)) {
            $dotenv = Dotenv\Dotenv::createImmutable(__DIR__); // Chargement.env
            $dotenv->load();

            $required_vars = ['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASSWORD'];
            foreach ($required_vars as $var) {
                if (!isset($_SERVER[$var])) {
                    throw new Exception("Missing environment variable: $var");
                }
            }
        }

        $db_host = $_SERVER['DB_HOST'];
        $db_name = $_SERVER['DB_NAME'];
        $db_user = $_SERVER['DB_USER'];
        $db_pass = $_SERVER['DB_PASSWORD'];

            try {
                self::$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                throw new Exception("Erreur de connexion : " . $e->getMessage());
            }
        return self::$pdo;
    }
    public static function disconnect(): void {
        if (!is_null(self::$pdo)) {
            self::$pdo = null;
        }
    }

}
