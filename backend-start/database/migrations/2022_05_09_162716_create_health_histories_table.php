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
        Schema::create('health_histories', function (Blueprint $table) {
            $table->string('bilkentID');
            $table->id();
            $table->string('type');
            $table->string('path');
            $table->string('name')->unique();
            $table->string('uploaderID');
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
        Schema::dropIfExists('health_histories');
    }
};
