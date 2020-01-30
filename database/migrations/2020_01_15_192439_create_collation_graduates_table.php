<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollationGraduatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collation_graduates', function (Blueprint $table) {
            $table->bigIncrements('collation_graduates_id');
            $table->string('program_name')->nullable();
            $table->string('major_name')->nullable();
            $table->integer('total_male')->nullable()->unsigned();
            $table->integer('total_female')->nullable()->unsigned();
            $table->integer('total_graduate')->nullable()->unsigned();
            $table->unsignedBigInteger('institution_types_id');
            $table->timestamps();

            $table->foreign('institution_types_id')->references('institution_types_id')->on('institution_types')->onDelete('cascade');
        
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collation_graduates');
    }
}
