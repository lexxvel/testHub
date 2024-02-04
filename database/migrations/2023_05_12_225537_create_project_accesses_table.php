<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectAccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_accesses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('User_id');
            $table->unsignedBigInteger('Project_id');
            $table->timestamps();
            $table->foreign('User_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('Project_id')->references('Project_id')->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_accesses');
    }
}
