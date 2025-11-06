<?php
class Database {
    private static $instance = null;
    private $conn;

    private function __construct() {
        // Ambil konfigurasi DB (config/database.php harus mengandalkan getenv)
        $config = require __DIR__ . '/../../config/database.php';

        // Pastikan semua env ada (agar debug jelas)
        $host = $config['host'] ?? null;
        $port = $config['port'] ?? 3306;
        $dbname = $config['dbname'] ?? null;
        $username = $config['username'] ?? null;
        $password = $config['password'] ?? null;
        $charset = $config['charset'] ?? 'utf8mb4';

        if (!$host || !$dbname || !$username) {
            throw new Exception("Database environment variables missing (check Railway Variables).");
        }

        try {
            $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset={$charset}";
            $this->conn = new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (PDOException $e) {
            // lempar exception supaya index.php menangkap dan menampilkan pesan debug
            throw new Exception("Connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }

    private function __clone() {}
    public function __wakeup() {}
}
