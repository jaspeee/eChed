<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archives', function (Blueprint $table) {
            $table->bigIncrements('archives_id');
            $table->unsignedBigInteger('user_id');
            $table->string('file');
            $table->unsignedBigInteger('forms_id');
            $table->unsignedBigInteger('institutions_id');

            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('institutions_id')->references('institutions_id')->on('institutions')->onDelete('cascade');
            $table->foreign('forms_id')->references('forms_id')->on('forms')->onDelete('cascade');
            
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
        Schema::dropIfExists('archives');
    }
}
