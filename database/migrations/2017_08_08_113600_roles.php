<?php

use Ansta\LaraCms\Models\Role;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Roles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $roles = [
            'page',
            'author',
            'component',
            'site',
        ];

        $subRoles = [
            'create',
            'edit',
            'destroy',
            'index',
        ];

        foreach($roles as $role) {
            foreach($subRoles as $sub) {

                $model = new Role;
                $model->display_name = $sub.' '.$role;
                $model->name = $role.'.'.$sub;
                $model->save();
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

//        \DB::table('permission_role')->truncate();
//        \DB::table('role_user')->truncate();
//        \DB::table('roles')->truncate();
//        \DB::table('permissions')->truncate();
    }
}
