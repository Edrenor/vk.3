<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sources', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('channel_id');
            $table->integer('user_id');
            $table->text('link');
            $table->text('owner');
            $table->text('name');

            $table->boolean('images');
            $table->boolean('video');
            $table->boolean('gif');
            $table->boolean('text');
            $table->boolean('article');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sources');
    }
}
