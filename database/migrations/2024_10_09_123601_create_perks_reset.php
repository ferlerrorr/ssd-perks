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
        Schema::create('perks_reset', function (Blueprint $table) {
            $table->id();
            $table->string('admin_id', 360);
            $table->date('auto_reset_ca');
            $table->date('auto_reset_ar');
            $table->dateTime('manual_reset_ca');
            $table->dateTime('manual_reset_ar');
            $table->boolean('is_active')->default(true);

            /* Must get the value of the last active settings 
            overight the updated data of the last active 
            settings and make the last reset settings void
            */

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
        Schema::dropIfExists('perks_reset');
    }
};
