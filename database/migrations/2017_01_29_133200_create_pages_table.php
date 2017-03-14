<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            
            $table->integer('id')->primary();
            $table->string('page_sec_name')->unique();
            $table->string('page_title');
            $table->string('section_title');
            $table->tinyInteger('is_multi')->default(0);
            $table->tinyInteger('has_title')->default(0);
            $table->tinyInteger('has_heading1')->default(0);
            $table->tinyInteger('has_content')->default(0);
            $table->tinyInteger('has_image')->default(0);
            
            
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
        Schema::dropIfExists('pages');
    }
}
