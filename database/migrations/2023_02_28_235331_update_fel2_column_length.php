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
            $table->mediumText('project_scope_text')->change();
            $table->mediumText('identify_main_equipment_text')->change();
            $table->mediumText('boundary_and_assumption_text')->change();
            $table->mediumText('analysis_of_option_text')->change();
            $table->mediumText('permit_list_text')->change();
            $table->mediumText('schedule_project_text')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fel2s', function (Blueprint $table) {
            $table->text('project_scope_text')->change();
            $table->text('identify_main_equipment_text')->change();
            $table->text('boundary_and_assumption_text')->change();
            $table->text('analysis_of_option_text')->change();
            $table->text('permit_list_text')->change();
            $table->text('schedule_project_text')->change();
        });
    }
};
