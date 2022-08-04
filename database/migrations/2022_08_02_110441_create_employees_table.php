<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->String('first_name');
            $table->String('last_name');
            $table->BigInteger('company_id')->unsigned()->nullable();
            $table->foreign('company_id')->references('id')->on('companies');
            $table->String('email')->nullable();
            $table->integer('phone')->nullable();
            $table->String('profile_photo')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
