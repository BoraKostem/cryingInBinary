<?php

use App\Models\Admin;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('bilkentID');
            $table->string('password');
            $table->string('job');
            $table->string('firstLogin');
            $table->timestamps();
        });

         //Insert data into database
         $admin = new Admin;
         $admin->bilkentID = '11111111';
         $admin->password = Hash::make('admin');
         $admin->job = 'administrator';
         $admin->firstLogin = Hash::make('true');
         $save = $admin->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
};
