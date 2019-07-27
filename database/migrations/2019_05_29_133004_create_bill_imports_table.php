<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillImportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_imports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('date_of_import');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('provider_id')->unsigned();
            $table->integer('cost')->nullable();
            $table->string('note')->nullable();
            $table->integer('nhapkho');
            $table->bigInteger('payments')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('provider_id')->references('id')->on('providers')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bill_imports');
    }
}
