<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    DB::table('admins')->insert([
		    'name' => 'admin',
		    'email' => 'admin@webmaestro.com.ua',
		    'login' => 'admin',
		    'password' => \Hash::make( '123456' ),
	    ]);
    }
}
