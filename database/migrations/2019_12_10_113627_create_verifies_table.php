<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerifiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verifies', function (Blueprint $table) {
            $table->bigIncrements('verifies_id');
            $table->unsignedBigInteger('user_id');
            $table->string('validator_submission');
            $table->unsignedBigInteger('statuses_id');
            $table->mediumText('comment');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('statuses_id')->references('statuses_id')->on('statuses')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('verifies');
    }
}
