<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSpecsColProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->text('specs_en')->after('desc_ar');
            $table->text('specs_ar')->after('specs_en');
            $table->tinyInteger('discounted')->after('specs_ar')->default(0);
            $table->string('disc_amount')->after('discounted');
            
                 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('specs_en');
            $table->dropColumn('specs_ar'); 
            $table->dropColumn('discounted'); 
            $table->dropColumn('disc_amount'); 
        });
    }
}
