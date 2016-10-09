<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDvdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //        
        if(!Schema::hasTable('movies'))
        {
            Schema::dropIfExists(str_plural('dvd'));
        }
        
        Schema::create(str_plural('dvd'), function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('dvd_box_id')->unsigned()->comment('The DVD box where this DVD is put.');
            $table->string('title')->comment('DVD title.');
            $table->integer('movie_count')->default(0)->comment('Movies count in DVD.');
            $table->boolean('borrowable')->default(false)->comment('Confirmation of DVD has permission to borrow.');
            $table->boolean('borrowed')->default(false)->comment('Confirmation of DVD has borrowed by an user.');
            $table->enum('health', ['OK', 'LOST', 'BROKEN', 'DEAD'])->default('OK')->comment('Health of the DVD disk');
            $table->enum('status', ['REMOVED', 'HIDDEN', 'VISIBLE'])->default('VISIBLE')->comment('Status of the DVD availability');

            $table->softDeletes()->comment('If we want to keep track of deletion without actually deleting a record');
            $table->timestamps();
            $table->index(['id', 'dvd_box_id'], 'dvd_index');
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
        Schema::drop(str_plural('dvd'));
    }
}
