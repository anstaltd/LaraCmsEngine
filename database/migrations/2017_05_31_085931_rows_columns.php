<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RowsColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lara_cms_rows', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('position');
            $table->integer('page_id');
            $table->string('authorable_type');
            $table->string('updatable_type');
            $table->string('deletable_type');
            $table->integer('authorable_id');
            $table->integer('updatable_id');
            $table->integer('deletable_id');
            $table->text('config_data');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('lara_cms_columns', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('position');
            $table->integer('row_id');
            $table->text('html');
            $table->string('authorable_type');
            $table->string('updatable_type');
            $table->string('deletable_type');
            $table->integer('authorable_id');
            $table->integer('updatable_id');
            $table->integer('deletable_id');
            $table->text('config_data');
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
        Schema::dropIfExists('lara_cms_rows');
        Schema::dropIfExists('lara_cms_columns');
    }
}
