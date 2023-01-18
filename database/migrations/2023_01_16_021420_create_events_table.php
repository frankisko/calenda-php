<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id("id_event");
            $table->string("name", 255);
            $table->string("description", 255)->nullable();
            $table->timestamp("date");
            $table->string("status", 1)->default("A")->comment("A Active, I Inactive");
            $table->unsignedBigInteger('id_type');
            $table->foreign('id_type')->references('id_type')->on('types');
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
        Schema::dropIfExists('events');
    }
};
