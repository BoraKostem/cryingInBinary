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
            $table->integer('staffID')->unique();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('password');
            $table->string('job');
            $table->string('speciality')->nullable();
            $table->string('title')->nullable();
            $table->string('location'); //East Campus or Main Campus
            $table->string('hescode')->defult('0000');
            $table->string('pp_path')->defult('public/image/Profile-720.png'); //Profile Photo Path
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
