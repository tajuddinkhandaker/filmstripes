<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::dropIfExists(str_plural('movie'));
        
        Schema::create(str_plural('movie'), function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('dvd_id')->unsigned();
            $table->bigInteger('boxset_id')->unsigned();
            $table->string('title')->comment('Movie title.');
            $table->string('release_year')->default('2016')->comment('Movie release year.');
            $table->text('genres')->comment('Movie genres by comma separated.');
            $table->string('languages')->default('english')->comment('Movie languages by comma separated.');
            $table->integer('length')->default(0)->comment('Movie runtime duration in minutes.');
            $table->integer('resolution')->default(720)->comment('Movie picture quality in pixel width resolution.');
            $table->longText('poster_url')->nullable()->comment('Movie poster image URL.');
            $table->longText('imdb_info_url')->nullable()->comment('Movie info imdb URL.');
            $table->longText('comments')->nullable()->comment('Movie comments from uploader.');
            $table->timestamp('last_browsed_on')->comment('Last browsing timestamp');
            $table->bigInteger('last_browsed_by')->unsigned()->comment('Last browsing done by the user');
            $table->enum('health', ['GOOD', 'BAD', 'UNREADABLE'])->default('GOOD')->comment('Movie streaming condition.');
            $table->integer('size')->default(0)->comment('Movie file size in megabytes (Mbytes)');
            $table->enum('rip_quality', ['BRRIP', 'HD', 'CAM', 'DVDRIP', 'HDTV'])->default('BRRIP')->comment('Pirated movie release types.');
            $table->boolean('watched')->default(false)->comment('Confirmation of movie watched once');
            $table->boolean('burned')->default(false)->comment('Confirmation of movie burned to DVD.');
            $table->boolean('has_boxset')->default(false)->comment('Confirmation of movie has a boxset.');
            $table->boolean('downloaded')->default(false)->comment('Confirmation of movie has downloaded.');
            $table->boolean('is_adult')->default(false)->comment('Confirmation of movie is only for adults.');
            $table->boolean('editable')->default(false)->comment('Confirmation of movie is editable only for super users.');
            $table->boolean('searchable')->default(false)->comment('Confirmation of movie is searchable only for super users.');
            $table->enum('status', ['REMOVED', 'HIDDEN', 'VISIBLE'])->default('VISIBLE')->comment('Status of the movie availability');

            $table->softDeletes()->comment('If we want to keep track of deletion without actually deleting a record');
            $table->timestamps();
            $table->index(['id', 'user_id', 'dvd_id', 'boxset_id'], 'movies_index');
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
        Schema::drop(str_plural('movie'));
    }
}
