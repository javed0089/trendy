<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_en');
            $table->string('name_ar')->nullable();
            $table->string('designation_en')->nullable();
            $table->string('designation_ar')->nullable();
            $table->string('image',500)->nullable();
            $table->string('facebook',500)->nullable();
            $table->string('twitter',500)->nullable();
            $table->string('linkedin',500)->nullable();
            $table->tinyInteger('status')->nullable();
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
        Schema::dropIfExists('members');
    }
}
