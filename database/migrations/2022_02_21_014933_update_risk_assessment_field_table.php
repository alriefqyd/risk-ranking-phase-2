<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRiskAssessmentFieldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('risk_assessments', function (Blueprint $table) {
            $table->removeColumn('occupational_health');
            $table->removeColumn('safety');
            $table->removeColumn('financial_impact');
            $table->removeColumn('likelihood_factor');
            $table->removeColumn('risk_level');

            $table->integer('people')->nullable();
            $table->integer('finance')->nullable();
            $table->integer('probability')->nullable();
            $table->integer('priority_level')->nullable();
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
            $table->removeColumn('people');
            $table->removeColumn('finance');
            $table->removeColumn('probability');
            $table->removeColumn('priority_level');

            $table->integer('occupational_health')->nullable();
            $table->integer('safety')->nullable();
            $table->integer('financial_impact')->nullable();
            $table->integer('likelihood_factor')->nullable();
            $table->integer('risk_level')->nullable();
        });
    }
}
