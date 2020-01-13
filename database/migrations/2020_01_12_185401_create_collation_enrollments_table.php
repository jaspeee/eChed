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
            $table->string('program_name')->nullable();
            $table->string('major_name')->nullable();
            $table->integer('total_male')->nullable()->unsigned();;
            $table->integer('total_female')->nullable()->unsigned();;
            $table->integer('total_enrollment')->nullable()->unsigned();;
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
        Schema::dropIfExists('collation_enrollments');
    }
}
