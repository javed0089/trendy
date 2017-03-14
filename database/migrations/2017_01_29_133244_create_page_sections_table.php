<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_sections', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('page_id');
            $table->string('title_en')->nullable();
            $table->string('title_ar')->nullable();
            $table->string('heading1_en')->nullable();
            $table->string('heading1_ar')->nullable();
            $table->Text('content_en')->nullable();
            $table->Text('content_ar')->nullable();
            $table->string('image_en',1000)->nullable();
            $table->string('image_ar',1000)->nullable();
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
        Schema::dropIfExists('page_sections');
    }
}
