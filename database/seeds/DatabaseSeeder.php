<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    protected $toTruncate = [
        'users',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        foreach ($this->toTruncate as $table) {
            DB::table($table)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->call(UserTableSeeder::class);

        Model::reguard();
    }
}
