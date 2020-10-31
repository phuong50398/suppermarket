<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillExportDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_export_details', function (Blueprint $table) {
            // $table->bigIncrements('id');
            $table->bigInteger('bill_export_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->integer('amount_export');
            $table->integer('price_export');
            $table->timestamps();
            $table->primary(array('bill_export_id', 'product_id'));

            $table->foreign('bill_export_id')->references('id')->on('bill_exports')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bill_export_details');
    }
}
