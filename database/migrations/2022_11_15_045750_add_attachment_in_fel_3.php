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
        Schema::table('fel3s', function (Blueprint $table) {
            $table->text('executive_summary_text')->nullable();
            $table->text('problem_statement_text')->nullable();
            $table->text('project_scope_text')->nullable();
            $table->text('alternatives_and_best_option_text')->nullable();
            $table->text('project_schedule_text')->nullable();
            $table->text('list_of_equipment_and_specification_text')->nullable();
            $table->text('hazop_study_text')->nullable();
            $table->text('cost_estimate_text')->nullable();
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
        Schema::table('fel3s', function (Blueprint $table) {
            //
        });
    }
};
