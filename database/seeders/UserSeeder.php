<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    	$id = mt_rand(1000,9999);
        \DB::table('users')->insert([
            'name' => 'user_'.$id,
            'email' => 'user_'.$id.'@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }

}
