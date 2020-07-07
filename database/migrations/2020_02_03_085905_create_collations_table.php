<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collations', function (Blueprint $table) {
            $table->bigIncrements('collations_id');
            $table->unsignedBigInteger('institutions_id')->nullable()->unsigned();
            $table->string('program_name')->nullable(); 
            $table->string('major_name')->nullable();
            $table->unsignedBigInteger('discipline_groups_id')->nullable()->unsigned();
            $table->integer('tuition')->nullable()->unsigned();
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
            $table->integer('TME')->nullable()->unsigned();
            $table->integer('TFE')->nullable()->unsigned();
            $table->integer('TE')->nullable()->unsigned();
            $table->integer('TMG')->nullable()->unsigned();
            $table->integer('TFG')->nullable()->unsigned();
            $table->integer('TG')->nullable()->unsigned();
            $table->unsignedBigInteger('institution_types_id');
            $table->integer('collation_lists_id');
            $table->timestamps();
             
            $table->foreign('institution_types_id')->references('institution_types_id')->on('institution_types')->onDelete('cascade');
            $table->foreign('institutions_id')->references('institutions_id')->on('institutions')->onDelete('cascade');
            $table->foreign('discipline_groups_id')->references('discipline_groups_id')->on('discipline_groups')->onDelete('cascade');
            //$table->foreign('collation_lists_id')->references('collation_lists_id')->on('collation_lists')->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collations');
    }
}
