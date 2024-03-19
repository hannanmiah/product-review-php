<?php

use Hannan\ProductReview\Database\Blueprint;
use Hannan\ProductReview\Database\Migration;
use Hannan\ProductReview\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->integer('user_id');
            $table->string('body');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
};