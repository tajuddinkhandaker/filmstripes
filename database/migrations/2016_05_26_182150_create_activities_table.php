<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::dropIfExists('activities');

        Schema::create('activities', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('user_id')->unsigned()->comment('The user who acted.');
            $table->bigInteger('movie_id')->unsigned()->comment('The movie on which the action was taken.');
            $table->enum('action', ['VIEWED', 'LIKED', 'DISLIKED', 'ORDERED', 'BORROWED', 'ADDED', 'REMOVED', 'LOGGED_IN', 'SIGNED_OUT'])->default('LOGGED_IN')->comment('User actions on movies.');

            $table->softDeletes()->comment('If we want to keep track of deletion without actually deleting a record');
            $table->timestamps();
            $table->index(['id', 'user_id', 'movie_id'], 'activities_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('activities');
    }
}
