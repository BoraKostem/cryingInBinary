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
        Schema::create('users', function (Blueprint $table) {
            $table->integer('bilkent_id')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->integer('phone')->unique();
            $table->string('password');
            $table->string('hescode')->defult('0000');
            $table->date('birthday');
            $table->double('height');
            $table->double('weight');
            $table->string('blood_type');
            $table->string('pp_path');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
