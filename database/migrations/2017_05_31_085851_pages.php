<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lara_cms_pages', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->integer('site_id');
            $table->string('authorable_type');
            $table->string('updatable_type');
            $table->string('deletable_type');
            $table->integer('authorable_id');
            $table->integer('updatable_id');
            $table->integer('deletable_id');
            $table->text('config_data');
            $table->dateTime('available_at');
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
        Schema::dropIfExists('lara_cms_pages');
    }
}
