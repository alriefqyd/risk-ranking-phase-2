<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFel1sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fel1s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->unique();
            $table->boolean('project_scope')->nullable();
            $table->boolean('identified_parameter_requirement_regulation')->nullable();
            $table->boolean('alternatives')->nullable();
            $table->boolean('list_of_stakeholder')->nullable();
            $table->boolean('schedule_project')->nullable();
            $table->string('status')->nullable();
            $table->foreignId('created_by')->nullable();
            $table->string('department')->nullable();
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
        Schema::dropIfExists('fel1s');
    }
}
