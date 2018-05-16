<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->nullable();
            $table->integer('cat')->nullable();
            $table->string('image')->nullable();
            $table->text('code')->nullable();
            $table->text('des')->nullable();
            $table->text('detail')->nullable();
            $table->string('page_title')->nullable();
            $table->boolean('public')->nullable();
            $table->boolean('new')->nullable();
            $table->boolean('highlight')->nullable();
            $table->string('slug')->nullable();
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
        Schema::dropIfExists('video');
    }
}
