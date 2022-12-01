<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFel2sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fel2s', function (Blueprint $table) {
            $table->id();
            $table->boolean('project_scope')->nullable();
            $table->boolean('identify_main_equipment')->nullable();
            $table->boolean('boundary_and_assumption')->nullable();
            $table->boolean('analysis_of_option')->nullable();
            $table->boolean('permit_list')->nullable();
            $table->boolean('schedule_project')->nullable();
            $table->boolean('cost_estimate')->nullable();
            $table->string('status')->nullable();
            $table->foreignId('created_by')->nullable();
            $table->foreignId('project_id');
            $table->string('department');
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
        Schema::dropIfExists('fel2s');
    }
}
