<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attitudes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url');
            $table->string('gender');
            $table->string('culture');
            $table->string('born');
            $table->string('died');
            $table->string('father');
            $table->string('mother');
            $table->string('spouse');
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
        Schema::dropIfExists('attitudes');
    }
}
