<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTyresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tyres', function (Blueprint $table) {
            $table->id();
            $table->string('width')->nullable();
            $table->string('height')->nullable();
            $table->string('diameter')->nullable();
            $table->string('country_originals')->nullable();
            $table->string('speed_index')->nullable();
            $table->string('quantity')->nullable();
            $table->string('branch')->nullable();
            $table->string('location')->nullable();
            $table->string('note')->nullable();

            $table->string('brand')->nullable();
            $table->string('week')->nullable();
            $table->string('year')->nullable();

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
        Schema::dropIfExists('tyres');
    }
}
