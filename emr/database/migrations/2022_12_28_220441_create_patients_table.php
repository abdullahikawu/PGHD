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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string("pid");
            $table->string("emr_pid")->nullable();
            $table->string("emr_code", 1000)->nullable();
            $table->string("fitbit_code", 1000)->nullable();
            $table->string("fitbit_access_token", 1000)->nullable();
            $table->string("emr_expiry_date")->nullable();
            $table->string("email")->nullable();
            $table->string("password")->nullable();
            $table->longText("meta")->nullable();
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
        Schema::dropIfExists('patients');
    }
};
