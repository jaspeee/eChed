<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollationEnrollmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collation_enrollments', function (Blueprint $table) {
            $table->bigIncrements('collation_enrollments_id');
            $table->unsignedBigInteger('institutions_id')->nullable()->unsigned();
            $table->string('program_name')->nullable();
            $table->string('major_name')->nullable();
            $table->integer('0M')->nullable()->unsigned();
            $table->integer('0F')->nullable()->unsigned();
            $table->integer('1M')->nullable()->unsigned();
            $table->integer('1F')->nullable()->unsigned();
            $table->integer('2M')->nullable()->unsigned();
            $table->integer('2F')->nullable()->unsigned();
            $table->integer('3M')->nullable()->unsigned();
            $table->integer('3F')->nullable()->unsigned();
            $table->integer('4M')->nullable()->unsigned();
            $table->integer('4F')->nullable()->unsigned();
            $table->integer('5M')->nullable()->unsigned();
            $table->integer('5F')->nullable()->unsigned();
            $table->integer('6M')->nullable()->unsigned();
            $table->integer('6F')->nullable()->unsigned();
            $table->integer('7M')->nullable()->unsigned();
            $table->integer('7F')->nullable()->unsigned();
            $table->integer('total_male')->nullable()->unsigned();
            $table->integer('total_female')->nullable()->unsigned();
            $table->integer('total_enrollment')->nullable()->unsigned();
            $table->unsignedBigInteger('institution_types_id');
            $table->timestamps();
            
            $table->foreign('institution_types_id')->references('institution_types_id')->on('institution_types')->onDelete('cascade');
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
        Schema::dropIfExists('collation_enrollments');
    }
}
