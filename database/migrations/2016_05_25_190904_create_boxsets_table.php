<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoxsetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::dropIfExists(str_plural('boxset'));

        Schema::create('boxsets', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('title')->comment('Movie boxset title.');
            $table->text('genres')->comment('Movie boxset genres by comma separated.');
            $table->integer('volume_count')->default(0)->comment('Movie count in a boxset.');

            $table->softDeletes()->comment('If we want to keep track of deletion without actually deleting a record');
            $table->timestamps();
            $table->index(['id', 'created_at'], 'boxsets_index');
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
        Schema::drop(str_plural('boxset'));
    }
}
