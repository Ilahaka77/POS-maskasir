<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
           [ 
               [
                    'name' => 'Super Admin',
                    'email' => 'superadmin@email.com',
                    'email_verified_at' => Carbon::now(),
                    'password' => Hash::make('password'),
                    'role' => 'admin'
                ],
                [
                    'name' => 'Staff',
                    'email' => 'staff@gmail.com',
                    'email_verified_at' => Carbon::now(),
                    'password' => Hash::make('12345678'),
                    'role' => 'staff'
                ],
                [
                    'name' => 'Staff',
                    'email' => 'ahmad.ilahaka7@gmail.com',
                    'email_verified_at' => null,
                    'password' => Hash::make('12345678'),
                    'role' => 'staff'
                ],
                [
                    'name' => 'Kasir',
                    'email' => 'kasir@gmail.com',
                    'email_verified_at' => Carbon::now(),
                    'password' => Hash::make('12345678'),
                    'role' => 'kasir'
                ],
            ]
        );
    }
}
