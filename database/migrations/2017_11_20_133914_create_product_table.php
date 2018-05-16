<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->nullable();
            $table->integer('cat')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('image')->nullable();
            $table->string('unit')->nullable();
            $table->string('product_code')->nullable();
            $table->text('des')->nullable();
            $table->text('detail')->nullable();
            $table->text('promotion')->nullable();
            $table->string('page_title')->nullable();
            $table->boolean('public')->nullable();
            $table->boolean('new')->nullable();
            $table->boolean('highlight')->nullable();
            $table->string('slug')->nullable();
            $table->boolean('sale')->nullable();
            $table->integer('view_count')->nullable();
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
        Schema::dropIfExists('product');
    }
}
