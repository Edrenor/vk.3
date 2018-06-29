<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStopWordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stop_words', function (Blueprint $table) {

            $table->bigInteger('user_id');
            $table->bigInteger('owner_id');
            $table->text('stop_words');
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
        Schema::dropIfExists('stop_words');
    }
}
