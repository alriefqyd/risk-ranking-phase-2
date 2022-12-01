<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAssessmentTableInputText extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assessments', function (Blueprint $table) {
            $table->text('problem_statement_text')->nullable();
            $table->text('objective_text')->nullable();
            $table->text('project_scope_text')->nullable();
            $table->text('key_performance_metric_text')->nullable();
            $table->text('key_project_risk_and_mitigants_text')->nullable();
            $table->text('impact_if_not_executed_text')->nullable();
            $table->text('alternatives_to_proposal_text')->nullable();
            $table->text('cost_estimate_text')->nullable();
            $table->text('complexity_score_text')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assessments', function (Blueprint $table) {
            $table->dropColumn('problem_statement_text');
            $table->dropColumn('objective_text');
            $table->dropColumn('project_scope_text');
            $table->dropColumn('key_performance_metric_text');
            $table->dropColumn('key_project_risk_and_mitigants_text');
            $table->dropColumn('impact_if_not_executed_text');
            $table->dropColumn('alternatives_to_proposal_text');
            $table->dropColumn('cost_estimate_text');
            $table->dropColumn('complexity_score_text');
        });
    }
}
