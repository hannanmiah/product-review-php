<?php

namespace Hannan\ProductReview\Database;

class Schema
{
    protected $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function create($table, $callback)
    {
        $blueprint = new Blueprint;
        $callback($blueprint);

        $columns = implode(', ', $blueprint->columns);
        $query = "CREATE TABLE $table ($columns)";

        $this->database->executeQuery($query, []);
    }

    // Add more methods for other operations as needed
    public function dropIfExists($table)
    {
        $query = "DROP TABLE IF EXISTS $table";
        $this->database->executeQuery($query, []);
    }
}