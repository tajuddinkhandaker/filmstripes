<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDvdBoxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if(!Schema::hasTable('dvds'))
        {
            Schema::dropIfExists(str_plural('dvd_box'));
        }
        
        Schema::create(str_plural('dvd_box'), function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('title')->comment('DVD box title.');
            $table->integer('dvd_count')->default(0)->comment('DVD count in box.');
            $table->enum('box_location', ['CLOUD', 'HDD', 'LOCAL_SERVER', 'REMOTE_SERVER', 'TORRENT'])->default('LOCAL_SERVER')->comment('Box storage location type');
            $table->longtext('box_storage_url')->comment('Box storage URL');
            $table->integer('capacity')->default(0)->comment('DVD capacity in box.');

            $table->softDeletes()->comment('If we want to keep track of deletion without actually deleting a record');
            $table->timestamps();
            $table->index(['id', 'created_at'], 'dvd_boxes_index');
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
        Schema::drop(str_plural('dvd_box'));
    }
}
