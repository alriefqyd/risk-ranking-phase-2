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
            $table->text('project_scope_text')->nullable();
            $table->text('identified_parameter_requirement_regulation_text')->nullable();
            $table->text('alternatives_text')->nullable();
            $table->text('list_of_stakeholder_text')->nullable();
            $table->text('schedule_project_text')->nullable();
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
            $table->dropColumn('project_scope_text')->nullable();
            $table->dropColumn('identified_parameter_requirement_regulation_text')->nullable();
            $table->dropColumn('alternatives_text')->nullable();
            $table->dropColumn('list_of_stakeholder_text')->nullable();
            $table->dropColumn('schedule_project_text')->nullable();
        });
    }
};
