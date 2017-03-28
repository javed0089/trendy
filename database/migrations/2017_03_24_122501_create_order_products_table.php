<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->integer('product_id');
            $table->string('product_name');
            $table->integer('quantity');
            $table->string('unit');
            $table->float('price',8,2);
            $table->string('port_of_delivery')->nullable();
            $table->string('delivery_terms');
            $table->string('payment_method');
            $table->tinyInteger('shipping_doc_invoice')->default(0);
            $table->tinyInteger('shipping_doc_packing_list')->default(0);
            $table->tinyInteger('shipping_doc_co')->default(0);
            $table->tinyInteger('shipping_doc_others')->default(0);
            $table->string('shipping_doc_others_text')->nullable();
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
        Schema::dropIfExists('order_products');
    }
}
