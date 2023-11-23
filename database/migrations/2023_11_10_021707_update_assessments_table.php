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
            $table->tinyInteger('project_schedule')->nullable();
            $table->tinyInteger('list_equipment_specification')->nullable();
            $table->tinyInteger('economic_evaluation')->nullable();
            $table->longText('project_schedule_text')->nullable();
            $table->longText('list_equipment_specification_text')->nullable();
            $table->longText('economic_evaluation_text')->nullable();
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
            $table->dropColumn('project_schedule');
            $table->dropColumn('list_equipment_specification');
            $table->dropColumn('key_performance_metric');
            $table->dropColumn('economic_evaluation');
            $table->dropColumn('project_schedule_text');
            $table->dropColumn('list_equipment_specification_text');
            $table->dropColumn('key_performance_metric_text');
            $table->dropColumn('economic_evaluation_text');
        });
    }
};
