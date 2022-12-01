<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveBcStatusAndNoteFromBc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_case_assessments', function (Blueprint $table) {
            $table->dropColumn('bc_status');
            $table->dropColumn('note');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_case_assessments', function (Blueprint $table) {
            $table->string('bc_status')->nullable();
            $table->mediumText('note')->nullable();
        });
    }
}
