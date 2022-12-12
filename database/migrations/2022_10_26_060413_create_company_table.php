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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id')->unique();
            $table->string('company_name');
            $table->string('address');
            $table->bigInteger('contact_no');
//            $table->id();
//            $table->string('company_name');
//            $table->string('company_address'); \

//            $table->string('company_contact_no');
//            $table->string('company_status');
//            $table->string('company_mission');
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
        Schema::dropIfExists('companies');
    }
};

