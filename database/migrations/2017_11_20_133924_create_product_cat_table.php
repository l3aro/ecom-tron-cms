<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_cat', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->integer('parent')->nullable();
            $table->string('image')->nullable();
            $table->text('des')->nullable();            
            $table->string('page_title')->nullable();      
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
        Schema::dropIfExists('product_cat');
    }
}
