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
        Schema::create('students_data', function (Blueprint $table) {
            $table->id();
            $table->integer("nisn")->unique();
            $table->string("name");
            $table->string("school_name");
            $table->date("birthday");
            $table->string("mother_name");
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
        Schema::dropIfExists('students_data');
    }
};
