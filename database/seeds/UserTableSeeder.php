<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class)->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin')
        ]);

        factory(\App\User::class)->create([
            'name' => 'user',
            'email' => 'user@example.com',
            'password' => Hash::make('user')
        ]);
    }
}
