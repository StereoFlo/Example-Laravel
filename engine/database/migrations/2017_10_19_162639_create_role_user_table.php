<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateRoleUserTable
 */
class CreateRoleUserTable extends Migration
{
    public function up()
    {
        Schema::create('role_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->index('role_id');
            $table->index('user_id');
            $table->index(['role_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('role_user');
    }
}
