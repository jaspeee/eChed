<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstitutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institutions', function (Blueprint $table) {
            $table->bigIncrements('institutions_id');
            $table->string('code');
            $table->string('institution_name');
            $table->string('abbreviation');
            $table->unsignedBigInteger('institution_types_id');
            $table->unsignedBigInteger('statuses_id');
            $table->timestamps();
           
            $table->foreign('institution_types_id')->references('institution_types_id')->on('institution_types')->onDelete('cascade');
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
        Schema::dropIfExists('institutions');
    }
}
