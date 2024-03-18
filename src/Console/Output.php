<?php

namespace Hannan\ProductReview\Console;

class Output
{
    public function error(string $message): void
    {
        fwrite(STDERR, $message);
    }

    public function success(string $message): void
    {
        $this->writeln("<info>$message</info>");
    }

    public function writeln(string $message): void
    {
        echo $message . "\n";
    }

    public function info(string $message): void
    {
        $this->writeln("<info>$message</info>");
    }

    public function comment(string $message): void
    {
        $this->writeln("<comment>$message</comment>");
    }

    public function question(string $message): void
    {
        $this->write("<question>$message</question>");
    }

    public function write(string $message): void
    {
        echo $message;
    }

    public function warning(string $message): void
    {
        $this->writeln("<warning>$message</warning>");
    }

    public function alert(string $message): void
    {
        $this->writeln("<alert>$message</alert>");
    }

    public function caution(string $message): void
    {
        $this->writeln("<caution>$message</caution>");
    }

    public function note(string $message): void
    {
        $this->writeln("<note>$message</note>");
    }

    public function table(array $headers, array $rows): void
    {
        $this->writeln(implode(' | ', $headers));
        $this->writeln(str_repeat('-', 80));

        foreach ($rows as $row) {
            $this->writeln(implode(' | ', $row));
        }
    }
}