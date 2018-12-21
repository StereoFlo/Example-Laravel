<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class WorkController
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
            $table->integer('userId');
            $table->integer('likes')->default(0);
            $table->text('description')->nullable();
            $table->boolean('approved')->default(false);
            $table->timestamps();
            $table->index('likes');
            $table->index('userId');
            $table->index('approved');
            $table->index(['approved', 'likes']);
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
