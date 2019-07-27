<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sale_id')->unsigned();
            $table->bigInteger('product_id')->unsigned()->nullable();

            $table->integer('amount_from')->nullable();
            $table->integer('amount_to')->nullable();
            $table->float('discount')->nullable();
            $table->string('unit')->nullable();
            $table->bigInteger('category_type_id')->unsigned()->nullable();
            $table->bigInteger('provider_id')->unsigned()->nullable();
            $table->bigInteger('producer_id')->unsigned()->nullable();

            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('category_type_id')->references('id')->on('category_types')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('provider_id')->references('id')->on('providers')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('producer_id')->references('id')->on('producers')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_products');
    }
}
