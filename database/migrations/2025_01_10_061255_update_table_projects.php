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
            $table->string('maintenance_reps')->change()->nullable();
            $table->string('operation_reps')->change()->nullable();
            $table->string('fel_123_project_ref')->change()->nullable();
            $table->string('bc_presenter')->change()->nullable();
            $table->string('bc_originator');
            $table->string('email_pic');
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
            $table->string('maintenance_reps')->change();
            $table->string('operation_reps')->change();
            $table->string('fel_123_project_ref')->change();
            $table->dropColumn('bc_originator');
            $table->dropColumn('bc_originator_email');
            $table->dropColumn('email_pic');
        });
    }
};
