<?php

namespace Hannan\ProductReview\Database;

use PDO;
use PDOException;

class Database
{
    private $conn;
    private $table;

    public function __construct(string $host, string $db_name, string $username, string $password)
    {
        $this->connect($host, $db_name, $username, $password);
    }

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

    public function table(string $table): self
    {
        $this->table = $table;
        return $this;
    }

    public function first(array $conditions, array $fields = []): array
    {
        $queryBuilder = $this->query($this->table)->where($conditions);

        if (!empty($fields)) {
            $queryBuilder->select($fields);
        }

        $query = $queryBuilder->first()->toSql();
        $result = $this->executeQuery($query, $conditions, true);
        return $result[0] ?? [];
    }

    public function query(string $table): QueryBuilder
    {
        return new QueryBuilder($table);
    }

    public function select(array $fields): array
    {
        $query = $this->query($this->table)->select($fields)->toSql();
        return $this->executeQuery($query, [], true);
    }

    public function executeQuery(string $query, array $params, bool $fetch = false): mixed
    {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $fetch ? $stmt->fetchAll(PDO::FETCH_ASSOC) : $stmt->rowCount();
        } catch (PDOException $exception) {
            echo "Query execution error: " . $exception->getMessage();
            return false;
        }
    }

    public function insert(array $data): bool
    {
        $query = $this->query($this->table)->insert($data)->toSql();
        return $this->executeQuery($query, $data);
    }

    public function update(array $data, array $conditions): bool
    {
        $query = $this->query($this->table)->update($data)->where($conditions)->toSql();
        return $this->executeQuery($query, array_merge($data, $conditions));
    }

    public function delete(array $conditions): bool
    {
        $query = $this->query($this->table)->delete()->where($conditions)->toSql();
        return $this->executeQuery($query, $conditions);
    }
}