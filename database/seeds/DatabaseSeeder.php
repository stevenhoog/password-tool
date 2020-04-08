<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

    	// Seed database with user data
    	DB::table('users')->insert([
    		'name' => 'Motivo',
    		'email' => 'welkom@motivo.nl',
    		'password' => Hash::make('Test123!')

    	]);
    }
}
