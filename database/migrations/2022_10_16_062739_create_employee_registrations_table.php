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
        Schema::create('employee_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('career_id')->constrained();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->char('province_code', 2);
            $table->char('city_code', 4);
            $table->char('district_code', 7);
            $table->char('village_code', 10);
            $table->timestamps();

            $table->softDeletes();

            // village
            $table->foreign('village_code')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'villages')
                ->onUpdate('cascade')->onDelete('restrict');
            // district
            $table->foreign('district_code')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'districts')
                ->onUpdate('cascade')->onDelete('restrict');
            // city
            $table->foreign('city_code')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'cities')
                ->onUpdate('cascade')->onDelete('restrict');
            // province
            $table->foreign('province_code')
                ->references('code')
                ->on(config('laravolt.indonesia.table_prefix') . 'provinces')
                ->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_registrations');
    }
};
