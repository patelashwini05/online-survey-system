<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
USE Illuminate\Support\Facades\DB;
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
        if(DB::table('users')->count() == 0){
            DB::table('users')->insert([
                [
                    'first_name' => 'Admin',
                    'last_name' => 'User',
                    'user_type' => 'management',
                    'status' => 'active',
                    'email' => 'admin@example.com',
                    'password' => Hash::make('admin@123'),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'first_name' => 'Ashwini',
                    'last_name' => 'Patel',
                    'user_type' => 'management',
                    'status' => 'active',
                    'email' => 'ashwini@example.com',
                    'password' => Hash::make('ashwini@123'),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'first_name' => 'Bansi',
                    'last_name' => 'Talavia',
                    'user_type' => 'staff',
                    'status' => 'active',
                    'email' => 'bansi@example.com',
                    'password' => Hash::make('bansi@123'),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'first_name' => 'Harshita',
                    'last_name' => 'Kakadiya',
                    'user_type' => 'staff',
                    'status' => 'active',
                    'email' => 'harshita@example.com',
                    'password' => Hash::make('harshita@123'),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'first_name' => 'Parth',
                    'last_name' => 'Rohit',
                    'user_type' => 'staff',
                    'status' => 'active',
                    'email' => 'parth@example.com',
                    'password' => Hash::make('parth@123'),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'first_name' => 'Dhruv',
                    'last_name' => 'Patel',
                    'user_type' => 'staff',
                    'status' => 'active',
                    'email' => 'dhruv@example.com',
                    'password' => Hash::make('dhruv@123'),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'first_name' => 'Khushali',
                    'last_name' => 'Kukadiya',
                    'user_type' => 'staff',
                    'status' => 'active',
                    'email' => 'khushali@example.com',
                    'password' => Hash::make('khushali@123'),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
            ]);
        }
        else{
            echo 'Users table not empty';
        }
    }
}
