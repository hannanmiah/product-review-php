<?php

namespace Hannan\ProductReview\Console;

use Exception;
use Hannan\ProductReview\Application;
use Hannan\ProductReview\Exceptions\CommandNotFoundException;
use Override;

class Kernel implements KernelContract
{
    public function __construct(public Application $app)
    {
    }

    #[Override]
    public function handle(Input $input, Output $output): int
    {
        $artisan = $this->app->get('artisan');

        $command = $input->getCommand();

        try {
            $artisan->run($command);
            return 0; // return 0 to indicate success
        } catch (CommandNotFoundException $e) {
            return 2; // return the exception code to indicate an error
        } catch (Exception $e) {
            return 3; // return the exception code to indicate an error
        }
    }

    #[Override]
    public function terminate(Input $input, int $status): void
    {
        echo match ($status) {
            0 => "Command executed successfully.\n",
            2 => "Command {$input->getCommand()} not found.\n",
            default => "An error occurred while executing the {$input->getCommand()}: $status.\n",
        };
    }
}