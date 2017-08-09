<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kalnoy\Nestedset\NestedSet;

class Components extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('components', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('page_id');
            $table->string('authorable_type');
            $table->string('updatable_type')->nullable();
            $table->string('deletable_type')->nullable();
            $table->integer('authorable_id');
            $table->integer('updatable_id')->nullable();
            $table->integer('deletable_id')->nullable();
            $table->text('config');
            NestedSet::columns($table);
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
        Schema::dropIfExists('components');
    }
}
