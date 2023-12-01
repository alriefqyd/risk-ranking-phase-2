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
            $table->tinyInteger('alternatives_and_analysis')->nullable();
            $table->longText('alternatives_and_analysis_text')->nullable();
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
            $table->dropColumn('alternatives_and_analysis');
            $table->dropColumn('alternatives_and_analysis_text');
        });
    }
};
