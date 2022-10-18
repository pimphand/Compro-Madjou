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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('company');
            $table->string('phone');
            $table->text('text')->comment('isi pesan');
            $table->string('ip')->nullable();
            $table->string('country')->nullable();
            $table->string('requirement')->comment('kebutuhan');
            $table->string('from')->comment('mengetahui madjou dari');
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
        Schema::dropIfExists('messages');
    }
};
