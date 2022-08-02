<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientExaminationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_examinations', function (Blueprint $table) {
            $table->id('MEID');
            $table->string('MEname');
            $table->string('Lab_Dep');
            $table->string('Doctor');
            $table->integer('Price');
            $table->date('Date');
            $table->time('Time');
            // hannen
            $table->BigInteger('created_by')->nullable();
            $table->unsignedBigInteger('PNO');
            $table->unsignedBigInteger('TID');
            $table->double('amount', 8, 2);
            $table->bigInteger('template_id')->unsigned();
            // $table->unsignedBigInteger('template_id');
            $table->foreign('PNO')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('TID')->references('id')->on('technician_labs')->onDelete('cascade');
            // $table->foreign('template_id')->references('id')->on('templates')->onDelete('cascade');
            // $table->foreign('template_id')->references('id')->on('templates');
            // $table->foreign('template_id')->references('id')->on('templates')->onDelete('cascade');
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
        Schema::dropIfExists('patient_examinations');
    }
}
