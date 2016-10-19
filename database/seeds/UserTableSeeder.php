<?php

use App\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

/**
 * Class UserTableSeeder
 */
class UserTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->addTestAdmin();
        $this->addTestUser();
    }

    private function addTestAdmin()
    {
        factory(User::class)->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => app('hash')->make('admin'),
        ]);

    }

    private function addTestUser()
    {
        factory(\App\User::class)->create([
            'name' => 'user',
            'email' => 'user@example.com',
            'password' => Hash::make('user')
        ]);

    }

}
