<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCapturersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capturers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('name');
            $table->string('mobileno')->unique();
            $table->string('pro_pic')->nullable();
            $table->enum('category', ['1', '2','3'])->default('1')->comment('1-Photographer,2-Videographer,3-Both');
            $table->string('experience')->nullable();
            $table->string('rating')->nullable();
            $table->enum('status', ['0', '1','-1'])->default('0')->comment('0-Not Active,1-Active,-1 Denied');
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
        Schema::dropIfExists('capturers');
    }
}
