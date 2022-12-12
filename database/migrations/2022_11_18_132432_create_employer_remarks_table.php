<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('employer_remarks', function (Blueprint $table) {
            $table->id();
            $table->integer('applicant_id');
            $table->string('remarks');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employer_remarks');
    }
};
