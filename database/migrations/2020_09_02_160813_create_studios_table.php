<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id')
                    ->references('id')
                    ->on('capturers')
                    ->onDelete('cascade');
            $table->string('name');
            $table->text('banner')->nullable();
            $table->text('address');
            $table->text('lat')->nullable();
            $table->text('lng')->nullable();
            $table->enum('status', ['0', '1','-1'])->default('0')->comment('0-Not Active,1-Active,-1:Denied');
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
        Schema::dropIfExists('studios');
    }
}
