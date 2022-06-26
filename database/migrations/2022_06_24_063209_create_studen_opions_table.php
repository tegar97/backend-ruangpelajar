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
        Schema::create('studen_opions', function (Blueprint $table) {
            $table->id();
            $table->integer('users_id');
            $table->integer('opiniTopic_id');
            $table->string('reason');
            $table->boolean('isPositifOpini');
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
        Schema::dropIfExists('studen_opions');
    }
};
