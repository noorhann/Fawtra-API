<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpeedIndicesTable extends Migration
{
    
    public function up()
    {
        Schema::create('speed_indices', function (Blueprint $table) {
            $table->id();
            $table->string('speed');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('speed_indices');
    }
}
