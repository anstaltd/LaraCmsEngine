<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Sites extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lara_cms_sites', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('domain');
            $table->boolean('active')->default(1);
            $table->string('updatable_type')->nullable();
            $table->string('deletable_type')->nullable();
            $table->integer('updatable_id')->nullable();
            $table->integer('deletable_id')->nullable();
            $table->text('config_data');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('lara_cms_author_sites', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('author_id');
            $table->integer('site_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lara_cms_sites');
        Schema::dropIfExists('lara_cms_author_sites');
    }
}
