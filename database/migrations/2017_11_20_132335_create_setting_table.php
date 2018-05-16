<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting', function (Blueprint $table) {
            $table->increments('id');

            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->string('company_website_url')->nullable();
            $table->string('company_tel')->nullable();
            $table->string('company_hotline')->nullable();
            $table->string('company_mobile')->nullable();
            $table->string('company_email')->nullable();
            $table->string('company_facebook_url')->nullable();

            $table->string('email_smtp_server')->nullable();
            $table->string('email_smtp_port')->nullable();
            $table->string('email_smtp_user')->nullable();
            $table->string('email_smtp_pass')->nullable();
            $table->string('email_smtp_name')->nullable();
            $table->string('email_smtp_email_address')->nullable();

            $table->string('seo_page_title')->nullable();
            $table->string('seo_meta_des')->nullable();
            $table->string('seo_meta_keywords')->nullable();
            $table->string('seo_meta_copyright')->nullable();
            $table->string('seo_meta_author')->nullable();
            $table->string('seo_meta_page_topic')->nullable();

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
        Schema::dropIfExists('setting');
    }
}
