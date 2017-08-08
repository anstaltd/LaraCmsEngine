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
        Schema::create('rows', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('position');
            $table->integer('page_id');
            $table->string('authorable_type');
            $table->string('updatable_type')->nullable();
            $table->string('deletable_type')->nullable();
            $table->integer('authorable_id');
            $table->integer('updatable_id')->nullable();
            $table->integer('deletable_id')->nullable();
            $table->text('config_data');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('columns', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('position');
            $table->integer('row_id');
            $table->string('authorable_type');
            $table->string('updatable_type')->nullable();
            $table->string('deletable_type')->nullable();
            $table->integer('authorable_id');
            $table->integer('updatable_id')->nullable();
            $table->integer('deletable_id')->nullable();
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
        Schema::dropIfExists('rows');
        Schema::dropIfExists('columns');
    }
}
