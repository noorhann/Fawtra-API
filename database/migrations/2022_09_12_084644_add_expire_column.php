<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExpireColumn extends Migration
{
    
    public function up()
    {
        Schema::table('tyres', function (Blueprint $table) {
            $table->integer('expire')->default(0);
        });
    }

    public function down()
    {
        //
    }
}
