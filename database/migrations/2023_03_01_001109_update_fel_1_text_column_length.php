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
        Schema::table('fel1s', function (Blueprint $table) {
            $table->mediumText('project_scope_text')->change();
            $table->mediumText('identified_parameter_requirement_regulation_text')->change();
            $table->mediumText('alternatives_text')->change();
            $table->mediumText('list_of_stakeholder_text')->change();
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
        Schema::table('fel1s', function (Blueprint $table) {
            $table->text('project_scope_text')->change();
            $table->text('identified_parameter_requirement_regulation_text')->change();
            $table->text('alternatives_text')->change();
            $table->text('list_of_stakeholder_text')->change();
            $table->text('schedule_project_text')->change();
        });
    }
};
