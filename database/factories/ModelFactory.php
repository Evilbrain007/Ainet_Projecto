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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'admin' => $faker->boolean(),
        'blocked' => $faker->boolean(),
        'phone' => '91'.$faker->randomNumber(7),
        'profile_photo' => $faker->name,
        'profile_url' => $faker->url,
        'presentation' => $faker->text,
        'print_evals' => $faker->randomNumber(2),
        'print_counts' => $faker->randomNumber(3),
        'department_id' => 1,
    ];
});
