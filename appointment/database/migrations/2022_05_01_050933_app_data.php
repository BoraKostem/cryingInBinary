<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('data', function (Blueprint $table) {
            $table->string('dataType');
            $table->longText('value');
            $table->string('lastEdited');
            $table->timestamps();
        });

        DB::table('data')->insert(
            array(
                'dataType' => 'healthNews',
                'value' => 'Placeholder News Please Change',
                'lastEdited' => 'Today'
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data');
    }
};