<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleryImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery_image', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('gallery_id')->nullable();
            $table->string('image')->nullable();
            $table->string('link_img')->nullable();
            $table->text('caption')->nullable();
            $table->boolean('public')->nullable();

            $table->string('language')->nullable();
            $table->integer('order')->nullable();
            $table->integer('updated_by')->nullable();

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
        Schema::dropIfExists('gallery_image');
    }
}
