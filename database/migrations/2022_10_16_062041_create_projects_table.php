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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_type_id')->constrained();
            $table->string('programing')->nullable();
            $table->string('title')->nullable();
            $table->string('slug');
            $table->string('body')->nullable();
            $table->string('url')->nullable();
            $table->string('location')->nullable();
            $table->string('lang')->default('id');
            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
