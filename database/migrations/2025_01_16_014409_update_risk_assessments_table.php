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
        Schema::table('risk_assessments', function (Blueprint $table) {
            $table->integer('risk_level_residual');
            $table->integer('risk_level_forecast');
            $table->integer('risk_level_deduction');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('risk_assessments', function (Blueprint $table) {
            $table->dropColumn('risk_level_residual');
            $table->dropColumn('risk_level_forecast');
            $table->dropColumn('risk_level_deduction');
        });
    }
};
