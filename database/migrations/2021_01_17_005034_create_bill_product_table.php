<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_bill')->unsigned();
            $table->string('product_description');
            $table->integer('product_price');
            $table->string('product_category');
            $table->integer('quantity');
            $table->integer('total');
            $table->timestamps();


            $table->foreign('id_bill')
            ->references('id')
            ->on('bills')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bill_product');
    }
}
