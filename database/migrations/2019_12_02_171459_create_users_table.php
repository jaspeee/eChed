<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->string('username');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('employee_profiles_id');
            $table->unsignedBigInteger('user_types_id');
            $table->unsignedBigInteger('statuses_id');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('employee_profiles_id')->references('employee_profiles_id')->on('employee_profiles')->onDelete('cascade');
            $table->foreign('user_types_id')->references('user_types_id')->on('user_types')->onDelete('cascade');
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
        Schema::dropIfExists('users');
    }
}
