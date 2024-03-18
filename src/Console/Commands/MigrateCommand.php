<?php

namespace Hannan\ProductReview\Console\Commands;

use Exception;

class MigrateCommand implements Command
{
    public function handle()
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
}