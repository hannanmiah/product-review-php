<?php

namespace Hannan\ProductReview\Database;

abstract class Migration
{
    abstract public function up();

    abstract public function down();
}