<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quote_id');
            $table->Integer('product_id');
            $table->string('product_desc',2000)->nullable();
            $table->string('quantity');
            $table->string('unit');
            $table->string('price')->nullable();
            $table->string('port_of_delivery')->nullable();
            $table->string('delivery_terms');
            $table->string('payment_method');
            $table->tinyInteger('shipping_doc_invoice')->default(0);
            $table->tinyInteger('shipping_doc_packing_list')->default(0);
            $table->tinyInteger('shipping_doc_co')->default(0);
            $table->tinyInteger('shipping_doc_others')->default(0);
            $table->string('shipping_doc_others_text')->nullable();
            $table->date('quote_validity')->nullable();
            $table->tinyInteger('status');
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
        Schema::dropIfExists('quote_details');
    }
}
