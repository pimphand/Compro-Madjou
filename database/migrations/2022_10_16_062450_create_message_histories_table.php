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
        Schema::create('message_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('message_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->string('status');
            $table->string('comment');
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
        Schema::dropIfExists('message_histories');
    }
};
