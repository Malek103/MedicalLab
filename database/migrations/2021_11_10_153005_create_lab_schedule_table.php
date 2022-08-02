<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_schedule', function (Blueprint $table) {
            $table->id('LID');
            $table->string('LName');
            $table->string('LLocation');
            $table->string('LPhone')->nullable();
            $table->text('Ldocument');
            $table->bigInteger('MID')->unsigned();
            $table->text('message')->nullable();
            $table->integer('status')->default(0);
            $table->foreign('MID')->references('id')->on('manager_labs')->onDelete('cascade');
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
        Schema::dropIfExists('lab_schedule');
    }
}
