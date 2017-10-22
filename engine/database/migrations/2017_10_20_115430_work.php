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
            $table->increments('id');
            $table->string('workName');
            $table->integer('likes')->default(0);
            $table->integer('userId');
            $table->text('description')->nullable();
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
