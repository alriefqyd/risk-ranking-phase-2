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
        Schema::table('business_case_assessments', function (Blueprint $table) {
            $table->text('problem_statement_and_objective_text')->nullable();
            $table->text('project_alternatives_text')->nullable();
            $table->text('project_scope_of_work_text')->nullable();
            $table->text('major_equipment_text')->nullable();
            $table->text('utility_requirements_text')->nullable();
            $table->text('permitting_text')->nullable();
            $table->text('social_community_and_government_text')->nullable();
            $table->text('financial_evaluation_text')->nullable();
            $table->text('additional_information_text')->nullable();
            $table->text('attachment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_case_assessments', function (Blueprint $table) {
            //
        });
    }
};
