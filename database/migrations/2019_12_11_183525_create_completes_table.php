<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompletesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('completes', function (Blueprint $table) {
            $table->bigIncrements('completes_id');
            $table->unsignedBigInteger('user_id');
            $table->string('verifier_submission');
            $table->unsignedBigInteger('forms_id');
            $table->unsignedBigInteger('institutions_id');
            $table->unsignedBigInteger('statuses_id');
            $table->mediumText('comment');
            $table->timestamps(); 

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('institutions_id')->references('institutions_id')->on('institutions')->onDelete('cascade');
            $table->foreign('forms_id')->references('forms_id')->on('forms')->onDelete('cascade');
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
        Schema::dropIfExists('completes');
    }
}
