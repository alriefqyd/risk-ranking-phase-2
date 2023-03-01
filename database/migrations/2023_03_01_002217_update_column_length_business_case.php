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
            $table->mediumText('problem_statement_and_objective_text')->change();
            $table->mediumText('project_alternatives_text')->change();
            $table->mediumText('project_scope_of_work_text')->change();
            $table->mediumText('major_equipment_text')->change();
            $table->mediumText('utility_requirements_text')->change();
            $table->mediumText('permitting_text')->change();
            $table->mediumText('social_community_and_government_text')->change();
            $table->mediumText('financial_evaluation_text')->change();
            $table->mediumText('additional_information_text')->change();
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
            $table->text('problem_statement_and_objective_text')->change();
            $table->text('project_alternatives_text')->change();
            $table->text('project_scope_of_work_text')->change();
            $table->text('major_equipment_text')->change();
            $table->text('utility_requirements_text')->change();
            $table->text('permitting_text')->change();
            $table->text('social_community_and_government_text')->change();
            $table->text('financial_evaluation_text')->change();
            $table->text('additional_information_text')->change();
        });
    }
};
