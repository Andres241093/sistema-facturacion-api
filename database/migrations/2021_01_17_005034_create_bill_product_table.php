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
            $table->bigInteger('id_product')->unsigned();
            $table->bigInteger('id_bill')->unsigned();
            $table->timestamps();

            $table->foreign('id_product')
            ->references('id')
            ->on('products')
            ->onUpdate('cascade')
            ->onDelete('cascade');

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
