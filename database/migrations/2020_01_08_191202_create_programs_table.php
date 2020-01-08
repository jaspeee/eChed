<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->bigIncrements('programs_id');
            $table->integer('code');
            $table->unsignedBigInteger('discipline_groups_id')->nullable()->unsigned();
            $table->unsignedBigInteger('program_levels_id');
            $table->string('program_name');
            $table->unsignedBigInteger('majors_id')->nullable()->unsigned();
            $table->timestamps();

            $table->foreign('discipline_groups_id')->references('discipline_groups_id')->on('discipline_groups')->onDelete('cascade');
            $table->foreign('program_levels_id')->references('program_levels_id')->on('program_levels')->onDelete('cascade');
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
        Schema::dropIfExists('programs');
    }
}
