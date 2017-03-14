<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameClientColTestimonials extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->renameColumn('cleint_name_ar','client_name_ar');
            $table->renameColumn('cleint_name_en','client_name_en');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->renameColumn('client_name_ar','cleint_name_ar');
            $table->renameColumn('client_name_en','cleint_name_en');
        });
    }
}
