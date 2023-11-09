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
        Schema::table('projects', function (Blueprint $table) {
            $table->string('operation_area');
            $table->string('sponsor_area');
            $table->string('maintenance_reps');
            $table->string('operation_reps');
            $table->string('fel_123_project_ref');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->removeColumn('operation_area');
            $table->removeColumn('sponsor_area');
            $table->removeColumn('maintenance_reps');
            $table->removeColumn('operation_reps');
            $table->removeColumn('fel_123_project_ref');
        });
    }
};
