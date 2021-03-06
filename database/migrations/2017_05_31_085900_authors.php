<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Authors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $author = new \App\User();
        Schema::table($author->table, function(Blueprint $table) {
            $table->softDeletes();
            $table->integer('default_image_id')->default(0);
            $table->dropColumn('name');
            $table->string('firstname');
            $table->string('lastname');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $author = new \App\User();
        Schema::table($author->table, function(Blueprint $table) {
            $table->dropColumn([
                'deleted_at',
                'default_image_id',
            ]);
            $table->string('name');
        });
    }
}
