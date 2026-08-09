<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->string('applicant_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name');

            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('zipcode');


            $table->string('sex');
            $table->string('civil_status');
            $table->date('birth_date');
            $table->string('birth_place');
            $table->bigInteger('age');
//            $table->string('user_name')->unique();
//            $table->string('password');
            $table->string('email_address');
            $table->bigInteger('contact_no');
            $table->string('degree');
            $table->string('file_attachment');
            $table->string('remarks');
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
        Schema::dropIfExists('applicants');
    }
};
