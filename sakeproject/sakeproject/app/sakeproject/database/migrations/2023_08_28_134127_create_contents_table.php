<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->increments('content_id');
            $table->integer('user_id')->references('id')->on('users');
            $table->string('title', 50);
            $table->string('image')->nullable();
            $table->string('comment', 100);
            $table->string('base', 100)->nullable();
            $table->string('taste', 100)->nullable();
            $table->string('dosuu', 100)->nullable();
            $table->string('recipe', 100)->nullable();
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
        Schema::dropIfExists('contents');
    }
}
