<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBorrowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::dropIfExists('borrowers');

        Schema::create('borrowers', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('dvd_id')->unsigned()->comment('The DVD which borrowed.');
            $table->string('borrowed_to')->comment('Movie borrowed to a person.');
            $table->dateTime('borrowed_on')->comment('Movie borrowed on the datetime.');
            $table->dateTime('deadline')->comment('Borrowed movie back deadline.');

            $table->softDeletes()->comment('If we want to keep track of deletion without actually deleting a record');
            $table->timestamps();
            $table->index(['id', 'dvd_id'], 'borrowers_index');
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
        Schema::drop('borrowers');
    }
}
