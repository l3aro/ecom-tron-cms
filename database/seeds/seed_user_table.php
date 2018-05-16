<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class seed_user_table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            array(
                'email' => 'admin@stal.dev',
                'name' => 'STAL',
                'address' => 'Some places over the rainbow',
                'mobile' => '0123456789',
                'admin' => 1,
                'password' => bcrypt('123654')
            )
        );
    }
}
