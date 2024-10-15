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
        Schema::create('e_pass_transaction', function (Blueprint $table) {
            $table->id();
            $table->string('cashier_id', 360);
            $table->string('employee_id', 360);
            $table->string('card_id', 360);
            $table->float('employee_ca');
            $table->float('employee_ar');
            $table->float('amount');
            $table->string('transaction_type', 360);
            $table->string('transaction_code', 360)->unique();
            $table->string('pos_rec_no', 360);
            $table->string('terminal_id', 360);
            $table->string('store_code', 360);
            $table->boolean('is_void')->default(false);
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
        Schema::dropIfExists('e_pass_transaction');
    }
};
