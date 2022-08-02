<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabScheduleTechnicianLabTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_schedule_technician_lab', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('lab_schedule_LID')->unsigned();
            $table->bigInteger('technician_lab_id')->unsigned();
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
        Schema::dropIfExists('lab_schedule_technician_lab');
    }
}
