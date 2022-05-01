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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->integer('patient_id');
            $table->integer('doctor_id');
            $table->longText('app_reason'); //Appointment Reason
            $table->date('date');
            $table->time('time');
            $table->integer('status')->default(0); // 0 = Waiting Appointment Time -- 1 = Patient Arrived -- 2 = Appointment Ended -- 3 = Patient Didn't Come -- 4 = Cancelled
            $table->double('blood_pressure')->nullable();
            $table->double('fewer')->nullable();
            $table->longText('perscription')->nullable();
            $table->integer('test_req')->nullable(); // Did doctor requested additional tests 1 = yes   0 = no  
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
        Schema::dropIfExists('appointments');
    }
};
