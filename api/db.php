<?php
class Database {
    private $pdo;
    private $db_file = __DIR__ . '/../clicks.sqlite'; 

    public function __construct() {
        $this->connect();
        $this->createTable();
    }

    private function connect() {
        try {
            $this->pdo = new PDO('sqlite:' . $this->db_file);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Database connection error: " . $e->getMessage());
            die("Database connection failed.");
        }
    }

    private function createTable() {
        $query = "
            CREATE TABLE IF NOT EXISTS page_clicks (
                page_name TEXT PRIMARY KEY,
                clicks INTEGER DEFAULT 0
            );
        ";
        try {
            $this->pdo->exec($query);
        } catch (PDOException $e) {
            error_log("Failed to create table: " . $e->getMessage());
            die("Failed to set up database table.");
        }
    }

    public function getPdo() {
        return $this->pdo;
    }
}
?>
