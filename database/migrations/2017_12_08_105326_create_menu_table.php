<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('menu');
        Schema::create('menu', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('name')->nullable();
            $table->integer('cat')->nullable();
            $table->integer('type')->nullable();
            $table->integer('article_cat')->nullable();
            $table->integer('article_id')->nullable();
            $table->integer('product_cat')->nullable();
            $table->integer('product_id')->nullable();
            $table->text('link')->nullable();
            $table->text('des')->nullable();
            $table->integer('parent')->nullable();
            $table->integer('order')->nullable();
            $table->string('language')->nullable();
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
        Schema::dropIfExists('menu');
    }
}
