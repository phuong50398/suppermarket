<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckroutersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkrouters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('router');
            $table->bigInteger('auth_id')->unsigned();
            $table->timestamps();

            $table->foreign('auth_id')->references('id')->on('auths')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checkrouters');
    }
}
