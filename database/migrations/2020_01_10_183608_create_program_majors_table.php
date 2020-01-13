<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramMajorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_majors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('programs_id');
            $table->unsignedBigInteger('majors_id');
            $table->timestamps();

            $table->foreign('programs_id')->references('programs_id')->on('programs')->onDelete('cascade');
            $table->foreign('majors_id')->references('majors_id')->on('majors')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('program_majors');
    }
}
