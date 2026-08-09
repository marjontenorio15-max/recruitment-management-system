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
        Schema::create('tbl_job_list', function (Blueprint $table) {

            $table->id();
            $table->string('title');
            $table->integer('company_id');
            $table->string('created_by');
            $table->integer('no_of_employee');
            $table->string('salary');
            $table->string('sex');
            $table->string('degree');
            $table->string('work_exp');
            $table->string('job_desc');
            $table->string('location');
            $table->boolean('status')->default(1);
//            $table->integer('company_id');
//            $table->string('category');
//            $table->string('occupation_title');
//            $table->integer('req_no_employees');
//            $table->double('salaries');
//            $table->string('duration_employment');
//            $table->string('qualification_work_experience');
//            $table->string('job_description');
//            $table->string('preferred_job');
//            $table->string('sector_vacancy');
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
        Schema::dropIfExists('tbl_job_list');
    }
};
