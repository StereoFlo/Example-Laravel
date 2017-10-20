<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class WorkImages
 */
class WorkImages extends Migration
{
    /**
     *
     */
    public function up()
    {
        Schema::create('workImages', function (Blueprint $table) {
            $table->increments('imageId');
            $table->integer('workId')->default(0);
            $table->boolean('isDefault')->default(false);
            $table->string('link')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->index('workId');
            $table->index(['workId', 'isDefault']);
        });
    }

    /**
     *
     */
    public function down()
    {
        Schema::dropIfExists('workImages');
    }
}
