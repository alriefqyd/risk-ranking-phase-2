<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnTextAssessment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assessments', function (Blueprint $table) {
            $table->text('level_project_text')->nullable();
            $table->text('detail_estimate_cost_text')->nullable();
            $table->text('detail_estimate_cost')->change()->nullable();
            $table->dropColumn('complexity_score_text');
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
            $table->dropColumn('level_project_text');
            $table->dropColumn('detail_estimate_cost_text');
            $table->dropColumn('detail_estimate_cost');
            $table->text('complexity_score_text');
        });
    }
}
