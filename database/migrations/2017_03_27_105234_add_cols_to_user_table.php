<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColsToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('backend_user')->after('last_name')->default('0');
            $table->ipAddress('ip_address')->after('last_name')->nullable();
            $table->string('website')->after('last_name')->nullable();
            $table->string('telephone')->after('last_name')->nullable();
            $table->string('mobile')->after('last_name')->nullable();
            $table->string('address')->after('last_name')->nullable();
            $table->string('city')->after('last_name')->nullable();
            $table->string('country')->after('last_name')->nullable();
            $table->string('company')->after('last_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('backend_user');
            $table->dropColumn('ip_address');
            $table->dropColumn('website');
            $table->dropColumn('telephone');
            $table->dropColumn('mobile');
            $table->dropColumn('address');
            $table->dropColumn('city');
            $table->dropColumn('country');
            $table->dropColumn('company');
        });
    }
}
