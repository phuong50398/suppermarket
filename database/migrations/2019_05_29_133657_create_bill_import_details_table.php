<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillImportDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_import_details', function (Blueprint $table) {
            $table->bigInteger('bill_import_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->integer('amount_import');
            $table->integer('price_import');
            $table->timestamps();
            $table->primary(array('bill_import_id', 'product_id'));

            $table->foreign('bill_import_id')->references('id')->on('bill_imports')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('bill_import_details');
    }
}
