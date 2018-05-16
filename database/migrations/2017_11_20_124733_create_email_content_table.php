<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_content', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->nullable();
            $table->string('send_when')->nullable();
            $table->string('need_value')->nullable();
            $table->text('detail')->nullable();

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
        Schema::dropIfExists('email_content');
    }
}
