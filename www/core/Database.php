<?php
namespace core;

use Exception;
use PDO;
use PDOException;

class Database {
    private static Database|null $instance = null;
    private PDO $connection;

    private string $host = 'localhost';  // DB host
    private string $dbname = 'test'; // DB name
    private string $username = 'test'; // DB username
    private string $password = 'test'; // DB password

    private function __construct() {
        try {
            $this->connection = new PDO(
                "mysql:host=$this->host;dbname=$this->dbname",
                $this->username,
                $this->password
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection error: " . $e->getMessage());
        }
    }

    // The singleton method to get the database instance
    public static function getInstance(): PDO
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance->connection;
    }
}
