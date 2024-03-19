<?php

namespace Hannan\ProductReview\Database;

class QueryBuilder
{
    protected string $table;
    protected ?int $limit = null;
    protected array $select = [];
    protected array $insert = [];
    protected array $update = [];
    protected array $delete = [];
    protected array $where = [];

    public function __construct(string $table)
    {
        $this->table = $table;
    }

    public function select(array $fields): self
    {
        $this->select = $fields;
        return $this;
    }

    public function insert(array $data): self
    {
        $this->insert = $data;
        return $this;
    }

    public function update(array $data): self
    {
        $this->update = $data;
        return $this;
    }

    public function delete(): self
    {
        $this->delete = [];
        return $this;
    }

    public function where(array $conditions): self
    {
        $this->where = $conditions;
        return $this;
    }

    public function first(): self
    {
        $this->limit = 1;
        return $this;
    }

    public function toSql(): string
    {
        // Build the SQL query based on the provided data
        // This is a simplified example and may not cover all cases
        if (!empty($this->select)) {
            $fields = implode(',', $this->select);
            $sql = "SELECT {$fields} FROM {$this->table}";
        } elseif (!empty($this->insert)) {
            $fields = implode(',', array_keys($this->insert));
            $values = ':' . implode(', :', array_keys($this->insert));
            $sql = "INSERT INTO {$this->table} ({$fields}) VALUES ({$values})";
        } elseif (!empty($this->update)) {
            $fields = array_keys($this->update);
            $setPart = implode(' = ?, ', $fields) . ' = ?';
            $sql = "UPDATE {$this->table} SET {$setPart}";
        } elseif (empty($this->delete)) {
            $sql = "DELETE FROM {$this->table}";
        }

        if (!empty($this->where)) {
            $wherePart = implode(' = ? AND ', array_keys($this->where)) . ' = ?';
            $sql .= " WHERE {$wherePart}";
        }
        if (isset($this->limit)) {
            $sql .= " LIMIT {$this->limit}";
        }

        return $sql;
    }
}