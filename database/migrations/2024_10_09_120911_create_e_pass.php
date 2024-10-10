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
        Schema::create('epass', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id', 360)->unique();
            $table->string('card_id', 360);
            $table->boolean('is_active');
            $table->float('employee_ca')->nullable();
            $table->float('employee_ar')->nullable();
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
        Schema::dropIfExists('e_pass');
    }
};
