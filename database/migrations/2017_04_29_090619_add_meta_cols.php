<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMetaCols extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blog_categories', function (Blueprint $table) {
            $table->string('meta_title_en')->nullable();
            $table->string('meta_description_en')->nullable();
            $table->string('meta_title_ar')->nullable();
            $table->string('meta_description_ar')->nullable();
        });

        Schema::table('brands', function (Blueprint $table) {
            $table->string('meta_title_en')->nullable();
            $table->string('meta_description_en')->nullable();
            $table->string('meta_title_ar')->nullable();
            $table->string('meta_description_ar')->nullable();
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->string('meta_title_en')->nullable();
            $table->string('meta_description_en')->nullable();
            $table->string('meta_title_ar')->nullable();
            $table->string('meta_description_ar')->nullable();
        });

        Schema::table('company', function (Blueprint $table) {
            $table->string('meta_title_en')->nullable();
            $table->string('meta_description_en')->nullable();
            $table->string('meta_title_ar')->nullable();
            $table->string('meta_description_ar')->nullable();
        });

        Schema::table('informations', function (Blueprint $table) {
            $table->string('meta_title_en')->nullable();
            $table->string('meta_description_en')->nullable();
            $table->string('meta_title_ar')->nullable();
            $table->string('meta_description_ar')->nullable();
        });

        Schema::table('jobs', function (Blueprint $table) {
            $table->string('meta_title_en')->nullable();
            $table->string('meta_description_en')->nullable();
            $table->string('meta_title_ar')->nullable();
            $table->string('meta_description_ar')->nullable();
        });

        Schema::table('news', function (Blueprint $table) {
            $table->string('meta_title_en')->nullable();
            $table->string('meta_description_en')->nullable();
            $table->string('meta_title_ar')->nullable();
            $table->string('meta_description_ar')->nullable();
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->string('meta_title_en')->nullable();
            $table->string('meta_description_en')->nullable();
            $table->string('meta_title_ar')->nullable();
            $table->string('meta_description_ar')->nullable();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->string('meta_title_en')->nullable();
            $table->string('meta_description_en')->nullable();
            $table->string('meta_title_ar')->nullable();
            $table->string('meta_description_ar')->nullable();
        });

        Schema::table('services', function (Blueprint $table) {
            $table->string('meta_title_en')->nullable();
            $table->string('meta_description_en')->nullable();
            $table->string('meta_title_ar')->nullable();
            $table->string('meta_description_ar')->nullable();
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->string('meta_title_en')->nullable();
            $table->string('meta_description_en')->nullable();
            $table->string('meta_title_ar')->nullable();
            $table->string('meta_description_ar')->nullable();
        });

        Schema::table('testimonials', function (Blueprint $table) {
            $table->string('meta_title_en')->nullable();
            $table->string('meta_description_en')->nullable();
            $table->string('meta_title_ar')->nullable();
            $table->string('meta_description_ar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blog_categories', function (Blueprint $table) {
            $table->dropColumn('meta_title_en');
            $table->dropColumn('meta_description_en');
            $table->dropColumn('meta_title_ar');
            $table->dropColumn('meta_description_ar');
        });

        Schema::table('brands', function (Blueprint $table) {
            $table->dropColumn('meta_title_en');
            $table->dropColumn('meta_description_en');
            $table->dropColumn('meta_title_ar');
            $table->dropColumn('meta_description_ar');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('meta_title_en');
            $table->dropColumn('meta_description_en');
            $table->dropColumn('meta_title_ar');
            $table->dropColumn('meta_description_ar');
        });

        Schema::table('company', function (Blueprint $table) {
            $table->dropColumn('meta_title_en');
            $table->dropColumn('meta_description_en');
            $table->dropColumn('meta_title_ar');
            $table->dropColumn('meta_description_ar');
        });

        Schema::table('informations', function (Blueprint $table) {
            $table->dropColumn('meta_title_en');
            $table->dropColumn('meta_description_en');
            $table->dropColumn('meta_title_ar');
            $table->dropColumn('meta_description_ar');
        });

        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn('meta_title_en');
            $table->dropColumn('meta_description_en');
            $table->dropColumn('meta_title_ar');
            $table->dropColumn('meta_description_ar');
        });

        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn('meta_title_en');
            $table->dropColumn('meta_description_en');
            $table->dropColumn('meta_title_ar');
            $table->dropColumn('meta_description_ar');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('meta_title_en');
            $table->dropColumn('meta_description_en');
            $table->dropColumn('meta_title_ar');
            $table->dropColumn('meta_description_ar');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('meta_title_en');
            $table->dropColumn('meta_description_en');
            $table->dropColumn('meta_title_ar');
            $table->dropColumn('meta_description_ar');
        });

        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('meta_title_en');
            $table->dropColumn('meta_description_en');
            $table->dropColumn('meta_title_ar');
            $table->dropColumn('meta_description_ar');
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->dropColumn('meta_title_en');
            $table->dropColumn('meta_description_en');
            $table->dropColumn('meta_title_ar');
            $table->dropColumn('meta_description_ar');
        });

        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn('meta_title_en');
            $table->dropColumn('meta_description_en');
            $table->dropColumn('meta_title_ar');
            $table->dropColumn('meta_description_ar');
        });

        
    }
}
