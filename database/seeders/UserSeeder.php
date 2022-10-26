<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;



class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Shawn Michaels',
            'email' => 'shawn@gmail.com',
            'password' => Hash::make('test'),
            'isAdmin' => 0,
            'leave_days' => 0
        ]);

        DB::table('users')->insert([
            'name' => 'Paul Levesque',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'isAdmin' => 1,
            'leave_days' => 0
        ]);



    }
}
