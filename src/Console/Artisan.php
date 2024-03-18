<?php

namespace Hannan\ProductReview\Console;

use Closure;
use Exception;
use Hannan\ProductReview\Console\Commands\Command;
use Hannan\ProductReview\Console\Commands\MigrateCommand;
use Hannan\ProductReview\Exceptions\CommandNotFoundException;

class Artisan
{
    protected array $commands = [];

    public function __construct()
    {
        $this->load();
    }

    private function load(): void
    {
        $this->commands = [
            'migrate' => new MigrateCommand()
        ];
    }

    public function command(string $name, Command|Closure $command): void
    {
        $this->commands[$name] = $command;
    }

    public function run(string $name): void
    {
        if (!isset($this->commands[$name])) {
            throw new CommandNotFoundException("Command '$name' not found.");
        }

        if ($this->commands[$name] instanceof Closure) {
            $this->commands[$name] = $this->commands[$name]();
        } else if ($this->commands[$name] instanceof Command) {
            $this->commands[$name]->handle();
        } else {
            throw new Exception("Invalid command type.");
        }
    }
}