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
            $table->string('first_name', 64);
            $table->string('last_name', 64)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('phone_number', 16);
            $table->string('email')->nullable();
            $table->integer('province_address')->nullable();
            $table->integer('city_address')->nullable();
            $table->string('street_address', 255)->nullable();
            $table->string('zip_code', 16)->nullable();
            $table->string('ktp_number', 16);
            $table->string('current_position', 64)->nullable();
            $table->integer('bank_account')->nullable();
            $table->string('bank_account_number', 255)->nullable();
            $table->string('ktp_file', 255)->nullable();
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
