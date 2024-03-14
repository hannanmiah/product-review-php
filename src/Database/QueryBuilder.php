<?php

namespace Hannan\ProductReview\Database;

class QueryBuilder
{
    protected $select = '*';
    protected $from;
    protected $where = [];
    protected $orderBy;
    protected $limit;

    public function select(string $fields): self
    {
        $this->select = $fields;
        return $this;
    }

    public function from(string $table): self
    {
        $this->from = $table;
        return $this;
    }

    public function where(string $field, string $operator, string $value): self
    {
        $this->where[] = [$field, $operator, $value];
        return $this;
    }

    public function orderBy(string $field, string $direction = 'ASC'): self
    {
        $this->orderBy = "$field $direction";
        return $this;
    }

    public function limit(int $limit): self
    {
        $this->limit = $limit;
        return $this;
    }

    public function getQuery(): string
    {
        $query = "SELECT {$this->select} FROM {$this->from}";

        if (!empty($this->where)) {
            $whereClauses = array_map(function ($clause) {
                return implode(' ', $clause);
            }, $this->where);
            $query .= ' WHERE ' . implode(' AND ', $whereClauses);
        }

        if ($this->orderBy) {
            $query .= " ORDER BY {$this->orderBy}";
        }

        if ($this->limit) {
            $query .= " LIMIT {$this->limit}";
        }

        return $query;
    }
}