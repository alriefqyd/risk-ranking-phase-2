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
        Schema::create('maturity_analysis', function (Blueprint $table) {
            $table->id();
            $table->text('value');
            $table->string('summary');
            $table->foreignId('fels_id');
            $table->string('fels_type');
            $table->string('maturity_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maturity_analysis');
    }
};
