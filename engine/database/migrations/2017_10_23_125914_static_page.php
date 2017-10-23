<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StaticPage extends Migration
{
    /**
     *
     */
    public function up()
    {
        Schema::create('static_page', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255);
            $table->text('content')->nullable();
            $table->boolean('isAnonymous')->default(true);
            $table->string('userId');
            $table->timestamps();
        });
    }

    /**
     *
     */
    public function down()
    {
        Schema::dropIfExists('static_page');
    }
}