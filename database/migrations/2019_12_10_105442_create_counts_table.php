<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counts', function (Blueprint $table) {
            $table->bigIncrements('counts_id');
            $table->unsignedBigInteger('institutions_id');
            $table->integer('vcount');
            $table->integer('fcount');
            $table->timestamps();

            $table->foreign('institutions_id')->references('institutions_id')->on('institutions')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('counts');
    }
}
