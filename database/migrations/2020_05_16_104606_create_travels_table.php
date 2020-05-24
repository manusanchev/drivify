<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travel', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('departure');
            $table->string('destination');
            $table->string('coordinates_departure');
            $table->string('coordinates_destination');
            $table->date('travel_date');
            $table->string('travel_code')->unique();
            $table->integer('passengers');
            $table->double('distance');
            $table->integer('duration');
            $table->integer('has_playlist')->default(0);
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
        Schema::dropIfExists('travel');
    }
}
