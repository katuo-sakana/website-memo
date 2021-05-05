<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name'              => 'ゲストユーザー',
                'email'             => 'guest@user.com',
                'password'          => Hash::make('yQ5wQP8C'),
                'remember_token'    => Str::random(10),
            ],
            [
                'name'              => 'user',
                'email'             => 'user@example.com',
                'password'          => Hash::make('QteZ2ZwS'),
                'remember_token'    => Str::random(10),
            ]
        ]);
    }
}
