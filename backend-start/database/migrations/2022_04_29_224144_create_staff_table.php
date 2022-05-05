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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('bilkentID')->unique();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('password');
            $table->string('job');
            $table->string('speciality')->nullable();
            $table->string('title')->nullable();
            $table->string('location'); //East Campus or Main Campus
            $table->string('hescode')->nullable();
            $table->string('pp_path')->nullable(); //Profile Photo Path
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
        Schema::dropIfExists('staff');
    }
};
