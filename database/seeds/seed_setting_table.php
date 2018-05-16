<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class seed_setting_table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('setting')->insert(
            array(
                'company_name' => 'STAL',
                'company_address'=> 'Viet Nam',
                'company_website_url'=> 'www.google.com',
                'company_tel'=> '000',
                'company_hotline'=> '000',
                'company_mobile'=> '000',
                'company_email'=> 'no-reply@gmail.com',
                'company_facebook_url'=> '',
                'email_smtp_server'=> 'smtp.gmail.com',
                'email_smtp_port'=> '587',
                'email_smtp_user'=> 'no-reply@gmail.com',
                'email_smtp_pass'=> '',
                'email_smtp_name'=> 'STAL - Automatic email',
                'email_smtp_email_address'=> 'no-reply@gmail.com',
                'seo_page_title'=> 'STAL',
                'seo_meta_des'=> 'STAL',
                'seo_meta_keywords'=> 'STAL',
                'seo_meta_copyright'=> 'STAL',
                'seo_meta_author'=> 'STAL',
                'seo_meta_page_topic'=> 'STAL'
            )
        );

    }
}
