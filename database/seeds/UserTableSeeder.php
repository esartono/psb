<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@nf.local',
            'phone' => '081295941985',
            'password' => Hash::make('123'),
            'email_verified_at' => '2019-08-30 00:00:00',
            'level' => 1
        ]); 

        User::create([
            'name' => 'Tes User',
            'email' => 'tes@nf.local',
            'phone' => '081295941985',
            'password' => Hash::make('123'),
            'email_verified_at' => '2019-08-30 00:00:00',
            'level' => 2
        ]); 
    }
}
