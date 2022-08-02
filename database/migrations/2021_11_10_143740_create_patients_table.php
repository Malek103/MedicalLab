<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('PID')->unique();
            $table->string('PName');
            $table->string('PAddress');
            $table->date('PDofB');
            $table->string('PGender');
            $table->string('PPhone');
            $table->unsignedBigInteger('ACNO');
            $table->unsignedBigInteger('lab_id');
            // $table->unsignedBigInteger('patient_id');

            $table->foreign('ACNO')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reversmanager migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
