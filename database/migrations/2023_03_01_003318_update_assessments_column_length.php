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
        Schema::table('assessments', function (Blueprint $table) {
            $table->mediumText('problem_statement_text')->change();
            $table->mediumText('objective_text')->change();
            $table->mediumText('project_scope_text')->change();
            $table->mediumText('key_performance_metric_text')->change();
            $table->mediumText('key_project_risk_and_mitigants_text')->change();
            $table->mediumText('impact_if_not_executed_text')->change();
            $table->mediumText('alternatives_to_proposal_text')->change();
            $table->mediumText('level_project_text')->change();
            $table->mediumText('detail_estimate_cost_text')->change();
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
            $table->text('problem_statement_text')->change();
            $table->text('objective_text')->change();
            $table->text('project_scope_text')->change();
            $table->text('key_performance_metric_text')->change();
            $table->text('key_project_risk_and_mitigants_text')->change();
            $table->text('impact_if_not_executed_text')->change();
            $table->text('alternatives_to_proposal_text')->change();
            $table->text('level_project_text')->change();
            $table->text('detail_estimate_cost_text')->change();
        });
    }
};
