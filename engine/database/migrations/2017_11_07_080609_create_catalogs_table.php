<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0)->index();
            $table->string('name');
            $table->text('description');
            $table->timestamps();
        });
        Schema::create('catalog_rel', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('catalog_id')->index();
            $table->integer('work_id')->index();
            $table->timestamps();
            $table->index(['catalog_id', 'work_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalog');
        Schema::dropIfExists('catalog_rel');
    }
}
