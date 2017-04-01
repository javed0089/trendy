<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColsToCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->string('fullname')->after('id');
            $table->string('email')->after('fullname');
            $table->string('phone')->after('email');
            $table->text('message')->after('phone');
            $table->ipAddress('ip_address')->after('message')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
             $table->dropColumn('fullname');
             $table->dropColumn('email');
             $table->dropColumn('phone');
             $table->dropColumn('message');
             $table->dropColumn('ip_address');
        });
    }
}
