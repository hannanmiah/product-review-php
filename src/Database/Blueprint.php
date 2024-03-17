<?php

namespace Hannan\ProductReview\Database;

class Blueprint
{
    public $columns = [];

    public function id()
    {
        $this->columns[] = "id INT AUTO_INCREMENT PRIMARY KEY";
    }

    public function string($column)
    {
        $this->columns[] = "$column VARCHAR(255)";
    }

    public function integer($column)
    {
        $this->columns[] = "$column INT";
    }

    // text
    public function text($column)
    {
        $this->columns[] = "$column TEXT";
    }
}