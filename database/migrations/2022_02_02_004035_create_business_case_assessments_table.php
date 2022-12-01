<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessCaseAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_case_assessments', function (Blueprint $table) {
            $table->id();
            $table->boolean('problem_statement_and_objective')->nullable();
            $table->boolean('project_alternatives')->nullable();
            $table->boolean('project_scope_of_work')->nullable();
            $table->boolean('major_equipment')->nullable();
            $table->boolean('utility_requirements')->nullable();
            $table->boolean('permitting')->nullable();
            $table->boolean('social_community_and_government')->nullable();
            $table->bigInteger('cost_estimate')->nullable();
            $table->boolean('financial_evaluation')->nullable();
            $table->boolean('risk_assessment')->nullable();
            $table->bigInteger('npv')->nullable();
            $table->bigInteger('irr')->nullable();
            $table->bigInteger('payback_period')->nullable();
            $table->boolean('additional_information')->nullable();
            $table->string('status')->nullable();
            $table->string('department');
            $table->foreignId('created_by');
            $table->foreignId('project_id');
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
        Schema::dropIfExists('business_case_assessments');
    }
}
