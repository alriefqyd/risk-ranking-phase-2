<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiskAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('risk_assessments', function (Blueprint $table) {
            $table->id();
            $table->integer('occupational_health')->nullable();
            $table->integer('safety')->nullable();
            $table->integer('environment')->nullable();
            $table->integer('reputation')->nullable();
            $table->integer('social_and_human_rights')->nullable();
            $table->integer('financial_impact')->nullable();
            $table->integer('final_impact_score')->nullable();
            $table->integer('likelihood_factor')->nullable();
            $table->integer('risk_level')->nullable();
            $table->foreignId('business_case_assessment_id');
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
        Schema::dropIfExists('risk_assessments');
    }
}
