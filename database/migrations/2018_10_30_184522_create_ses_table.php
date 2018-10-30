<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('full_name');
            $table->integer('gender');
            $table->integer('phone_number');
            $table->integer('sector');
            $table->integer('corridor');
            $table->integer('region');
            $table->integer('district');
            $table->integer('ward');
            $table->integer('village');
            $table->integer('equipment');
            $table->integer('price');
            $table->unsignedInteger('creator_id')->nullable();
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
        Schema::dropIfExists('ses');
    }
}
