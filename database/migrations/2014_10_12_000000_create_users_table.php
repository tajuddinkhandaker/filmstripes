<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('activities'))
        {
            Schema::dropIfExists(str_plural('users'));
        }
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('avatar')->default('default.png')->comment('User avatar image file name from private storage');
            $table->enum('privilege', ['SUPER_USER', 'VENDOR', 'THIRD_PARTY', 'CUSTOMER', 'DEVELOPER'])->default('CUSTOMER')->comment('User access privileges');
            $table->enum('status', ['REMOVED', 'OFFLINE', 'ONLINE'])->default('OFFLINE')->comment('User availablity status');
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
