<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order_details', function (Blueprint $table) {
            // $table->bigIncrements('id');
            $table->integer('amount');
            $table->float('price');
            $table->bigInteger('purchase_order_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('product_classification_id')->unsigned();
            $table->timestamps();
            $table->primary(array('purchase_order_id', 'product_id', 'product_classification_id'), 'purchase_detail_id');

            $table->foreign('purchase_order_id')->references('id')->on('purchase_orders')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('product_classification_id')->references('id')->on('product_classifications')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_order_details');
    }
}
