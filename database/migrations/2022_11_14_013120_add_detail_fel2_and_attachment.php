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
        Schema::table('fel2s', function (Blueprint $table) {
            $table->text('project_scope_text')->nullable();
            $table->text('identify_main_equipment_text')->nullable();
            $table->text('boundary_and_assumption_text')->nullable();
            $table->text('analysis_of_option_text')->nullable();
            $table->text('permit_list_text')->nullable();
            $table->text('schedule_project_text')->nullable();
            $table->text('cost_estimate_text')->nullable();
            $table->longText('attachment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fel1s', function (Blueprint $table) {
            //
        });
    }
};
