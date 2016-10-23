<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use Illuminate\Database\Eloquent\Factory as EloquentFactory;

$factory = app(EloquentFactory::class);

/**
 * @var Illuminate\Database\Eloquent\Factory $factory
 */
$factory->define(\App\User::class, function (\Faker\Generator $faker) {
    static $password;

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->safeEmail,
        'uuid' => $faker->uuid,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(\Modules\Core\Entities\Organization::class, function (\Faker\Generator $faker){
    return [
        'name' => $faker->company,
    ];
});
