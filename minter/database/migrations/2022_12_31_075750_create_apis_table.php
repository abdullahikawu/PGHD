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
        Schema::create('apis', function (Blueprint $table) {
            $table->id();
            $table->integer('pid');
            $table->string('user_id',200);
            $table->string("access_token_expiry_date")->nullable();
            $table->longText("scope")->nullable();
            $table->string("refresh_token_expiry_date")->nullable();
            $table->longText("access_token")->nullable();
            $table->longText("refresh_token")->nullable();
            $table->longText("code_challenge")->nullable();            
            $table->enum("name",['emr','fitbit','googlefit'])->default('emr');
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
        Schema::dropIfExists('apis');
    }
};
