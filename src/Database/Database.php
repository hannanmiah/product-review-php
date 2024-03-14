<?php

namespace Hannan\ProductReview\Database;

use PDO;
use PDOException;

class Database
{
    private $conn;

    public function __construct(string $host, string $db_name, string $username, string $password)
    {
        $this->connect($host, $db_name, $username, $password);
    }

    // Database connection
    private function connect(string $host, string $db_name, string $username, string $password): void
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $host . ";dbname=" . $db_name, $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
    }

    // Select data
    public function select(string $query): array
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Execute query (insert, update, delete)
    public function executeQuery(string $query, array $params): bool
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }
}