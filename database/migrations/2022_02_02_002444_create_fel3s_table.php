<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFel3sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fel3s', function (Blueprint $table) {
            $table->id();
            $table->boolean('executive_summary')->nullable();
            $table->boolean('problem_statement')->nullable();
            $table->boolean('project_scope')->nullable();
            $table->boolean('alternatives_and_best_option')->nullable();
            $table->boolean('project_schedule')->nullable();
            $table->boolean('list_of_equipment_and_specification')->nullable();
            $table->boolean('hazop_study')->nullable();
            $table->boolean('cost_estimate')->nullable();
            $table->foreignId('project_id')->nullable();
            $table->string('department');
            $table->string('status')->nullable();
            $table->foreignId('created_by');
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
        Schema::dropIfExists('fel3s');
    }
}
