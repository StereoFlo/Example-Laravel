<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class Work
 */
class Work extends Migration
{
    /**
     *
     */
    public function up()
    {
        Schema::create('work', function (Blueprint $table) {
            $table->increments('workId');
            $table->integer('likes');
            $table->integer('userId');
            $table->text('about');
            $table->timestamps();
            $table->index('userId');
        });
    }

    /**
     *
     */
    public function down()
    {
        Schema::dropIfExists('work');
    }
}
