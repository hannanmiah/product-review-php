<?php

use Hannan\ProductReview\Database\Migration;
use Hannan\ProductReview\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('users', function ($table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('password');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};