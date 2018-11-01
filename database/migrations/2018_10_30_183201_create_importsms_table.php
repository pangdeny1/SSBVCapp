<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImportsmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('importsms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('send_to');
            $table->string('text');
            $table->string('sender');
            $table->integer('batch_id');
            $table->enum("status", ["tosend", "sent"])->default("tosend");
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
        Schema::dropIfExists('importsms');
    }
}
