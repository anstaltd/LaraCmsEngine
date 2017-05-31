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
        $author = new \ChickenTikkaMasala\LaraCms\Models\Author();
        Schema::table($author->table, function(Blueprint $table) {
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
        $author = new \ChickenTikkaMasala\LaraCms\Models\Author();
        Schema::table($author->table, function(Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
    }
}
