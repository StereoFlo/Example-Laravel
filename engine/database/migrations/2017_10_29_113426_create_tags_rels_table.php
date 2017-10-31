<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateTagsRelsTable
 */
class CreateTagsRelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags_rels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('workId')->unsigned();
            $table->integer('tagId')->unsigned();
            $table->timestamps();
            $table->index('workId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags_rels');
    }
}
