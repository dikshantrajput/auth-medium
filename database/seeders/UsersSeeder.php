<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'name'=>'User 1',
                'email'=>'user1@gmail.com',
                'password'=>Hash::make('aaaaaaaa'),
                'email_verified_at'=>now(),
                'mobile'=>'1111111111'
            ],
            [
                'name'=>'User 2',
                'email'=>'user2@gmail.com',
                'password'=>Hash::make('bbbbbbbb'),
                'email_verified_at'=>now(),
                'mobile'=>'1111111111'
            ],
            [
                'name'=>'User 3',
                'email'=>'user3@gmail.com',
                'password'=>Hash::make('cccccccc'),
                'email_verified_at'=>now(),
                'mobile'=>'1111111111'
            ],
        ]);
    }
}
