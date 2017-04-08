<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColToOrderBlconfirm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->tinyInteger('bl_draft_confirmed')->after('paid')->default(0);
            $table->string('shipping_tracking_id')->after('bl_draft_confirmed')->nullable();
            $table->string('shipping_tracking_hyperlink')->after('shipping_tracking_id')->nullable();
             
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('bl_draft_confirmed');
            $table->dropColumn('shipping_tracking_id');
            $table->dropColumn('shipping_tracking_hyperlink');
        });
    }
}
