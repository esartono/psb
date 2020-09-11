<?php

use Illuminate\Database\Seeder;

use App\User;

class AdminUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            ['name' => 'Admin Pusat',
            'email' => 'pusat@nf.local',
            'phone' => '1234',
            'password' => Hash::make('123'),
            'email_verified_at' => '2020-08-29 00:00:00',
            'level' => 1]
        );
    }
}
