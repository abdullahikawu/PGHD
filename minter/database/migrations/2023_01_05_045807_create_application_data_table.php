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
        Schema::create('application_data', function (Blueprint $table) {
            $table->id();
            $table->integer('application_id');            
            $table->integer('field_id');
            $table->integer('form_id');
            $table->longText('field_value');
            $table->enum('status',['accepted','pending','rejected','defaulted'])->default('pending');
            $table->integer('status_updated_by')->nullable();
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
        Schema::dropIfExists('customer_data');
    }
};
