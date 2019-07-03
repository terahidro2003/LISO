<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('authentication_codes')->insert([
            'code' => 278901,
            'purpose' => 1,
            'created_by_user' => 0,
        ]);
        // $this->call(UsersTableSeeder::class);
    }
}
