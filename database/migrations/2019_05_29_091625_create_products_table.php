<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('sku')->nullable();
            $table->string('barcode')->nullable();
            $table->string('slug')->unique();
            $table->integer('price');
            $table->integer('number_sold')->nullable();
            $table->text('summary')->nullable();
            $table->text('description');
            $table->string('status')->nullable();
            $table->boolean('active');
            $table->text('images');
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('provider_id')->unsigned();
            $table->bigInteger('producer_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('products');
    }
}
