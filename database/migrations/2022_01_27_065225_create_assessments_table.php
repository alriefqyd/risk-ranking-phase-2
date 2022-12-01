<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->boolean('problems_statement')->nullable();
            $table->boolean('objective')->nullable();
            $table->boolean('project_scope')->nullable();
            $table->boolean('key_performance_metric')->nullable();
            $table->boolean('key_project_risk_mitigants')->nullable();
            $table->boolean('impact_if_not_executed')->nullable();
            $table->boolean('cost_estimate')->nullable();
            $table->text('complexity_score')->nullable();
            $table->boolean('level_project')->nullable();
            $table->text('note')->nullable();
            $table->string('status');
            $table->boolean('alternative_to_proposal')->nullable();
            $table->foreignId('user_id');
            $table->foreignId('project_id')->unique();
            $table->boolean('detail_estimate_cost')->nullable();
            $table->boolean('complexity_score_assessment')->nullable();
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
        Schema::dropIfExists('assessments');
    }
}
