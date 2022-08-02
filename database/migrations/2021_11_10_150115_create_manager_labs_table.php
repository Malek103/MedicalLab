<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManagerLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manager_labs', function (Blueprint $table) {
            $table->id();
            $table->string('MPhone');
            // $table->string('MAddress');
            $table->string('MName');
            // $table->text('message')->nullable();
            $table->BigInteger('ACNO')->unsigned();
            // $table->string('file_path')->nullable();
            $table->foreign('ACNO')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('manager_labs');
    }
}
