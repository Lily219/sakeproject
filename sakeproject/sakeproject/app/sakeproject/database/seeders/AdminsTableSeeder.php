<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        \DB::table('admins')->insert([
            [
              'email' => 'admin@gmail.com',
              'password' => Hash::make('password'),
            ],
          ]);

          \DB::table('admins')->insert([
            [
              'email' => 'adminadmin@gmail.com',
              'password' => '1234qwerasdfzxcv',
            ],
          ]);
    }
}
