<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('department_id');
            $table->String('location_en');
            $table->String('location_ar');
            $table->String('education_en');
            $table->String('education_ar');
            $table->String('experience_en');
            $table->String('experience_ar');
            $table->text('job_description_en');
            $table->text('job_description_ar');
            $table->text('responsibilities_en');
            $table->text('responsibilities_ar');
            $table->tinyInteger('job_status');
            
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
        Schema::dropIfExists('jobs');
    }
}
