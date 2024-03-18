<?php

namespace Hannan\ProductReview\Console;

use ArrayAccess;
use Override;

class Input implements ArrayAccess
{
    protected array $args;

    public function __construct()
    {
        global $argv;
        $this->args = $argv;
    }

    public function getCommand()
    {
        return $this->args[1] ?? '';
    }

    public function getArgument(int $index)
    {
        return $this->args[$index + 2] ?? '';
    }

    public function getArguments()
    {
        return array_slice($this->args, 2);
    }

    #[Override] public function offsetExists(mixed $offset): bool
    {
        return isset($this->args[$offset]);
    }

    #[Override] public function offsetGet(mixed $offset): mixed
    {
        return $this->args[$offset];
    }

    #[Override] public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->args[$offset] = $value;
    }

    #[Override] public function offsetUnset(mixed $offset): void
    {
        unset($this->args[$offset]);
    }
}