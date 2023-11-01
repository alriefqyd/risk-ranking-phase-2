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
        Schema::table('capex_investment_categories', function (Blueprint $table) {
            $table->text('sub_basket_categories')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('capex_investment_categories', function (Blueprint $table) {
            $table->removeColumn('sub_basket_categories');
        });
    }
};
