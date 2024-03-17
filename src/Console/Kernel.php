<?php

namespace Hannan\ProductReview\Console;

use Exception;
use Hannan\ProductReview\Application;

class Kernel
{
    public function __construct(public Application $app)
    {
    }

    public function migrate()
    {
        echo "Migrating...\n";
        try {
            $migrationFiles = glob(__DIR__ . '/../../migrations/*.php');
            sort($migrationFiles);

            foreach ($migrationFiles as $file) {
                $migration = require $file;
                // drop the table if it exists
                $migration->down();
                // create the table
                $migration->up();
            }
        } catch (Exception $e) {
            echo $e->getMessage() . "\n";
        }
        echo "Migration complete.\n";
    }

    // Add more methods for other commands as needed
}