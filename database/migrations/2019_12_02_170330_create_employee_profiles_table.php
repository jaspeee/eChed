<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_profiles', function (Blueprint $table) {
            $table->bigIncrements('employee_profiles_id');
            $table->string('first_name');
            $table->string('last_Name');
            $table->string('position');
            $table->string('division');
            $table->unsignedBigInteger('institutions_id');
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
        Schema::dropIfExists('employee_profiles');
    }
}
