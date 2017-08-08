<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Images extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('imagable_id');
            $table->string('imagable_type');
            $table->string('authorable_type');
            $table->integer('authorable_id');
            $table->string('updatable_type')->nullable();
            $table->integer('upadatable_id')->nullable();
            $table->string('deletable_type')->nullable();
            $table->integer('deletable_id')->nullable();
            $table->string('slug');
            $table->string('title');
            $table->string('path');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
}
