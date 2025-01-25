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
        Schema::table('business_case_assessments', function (Blueprint $table) {
            $table->longText('objective');
            $table->longText('kpi_summary');
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
            $table->dropColumn('objective');
            $table->dropColumn('kpi_summary');
        });
    }
};
