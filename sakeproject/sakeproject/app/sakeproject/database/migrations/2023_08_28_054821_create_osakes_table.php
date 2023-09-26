<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOsakesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('osakes', function (Blueprint $table) {
            $table->increments('osake_id');
            $table->string('title', 50);
            $table->string('image');
            $table->string('comment', 300);
            $table->integer('base_category_id');
            $table->integer('taste_category_id');
            $table->integer('dosuu_category_id');
            $table->string('recipe', 400);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('osakes');
    }
}
