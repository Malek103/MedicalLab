<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTechnicianLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technician_labs', function (Blueprint $table) {
            $table->id();
            $table->string('TPhone');
            $table->string('TAddress');
            $table->string('TName');
            
            ///hannen
            $table->unsignedBigInteger('create_by');
            $table->unsignedBigInteger('MID');
            $table->unsignedBigInteger('ACNO');
           // $table->unsignedBigInteger('manager_lab_id');
            $table->foreign('ACNO')->references('id')->on('users')->onDelete('cascade');
          //  $table->foreign('manager_lab_id')->references('id')->on('manager_labs')->onDelete('cascade');
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
        Schema::dropIfExists('technician_labs');
    }
}
