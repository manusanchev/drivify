<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpotifiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spotifies', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('user_id')->unsigned()->unique();
            $table->string('username');
            $table->string('country')->nullable();
            $table->string('facebook_ID')->nullable();
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
        Schema::dropIfExists('spotifies');
    }
}
