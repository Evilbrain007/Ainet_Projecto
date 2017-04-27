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


$factory->define(App\Printer::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
    ];
});


$factory->define(App\Departament::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
    ];
});

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('123123123'),
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

$factory->define(App\PrintRequest::class, function (Faker\Generator $faker) {

    return [
        'owner_id' => 1,
        'status' => $faker->boolean ? 1 : 0,
        'open_date' => \Carbon\Carbon::now(),
        'due_date' => \Carbon\Carbon::create(2020, 11, 21, 14, 3, 0),
        'description' => $faker->text(),
        'quantity' => $faker->randomNumber(2),
        'colored' => $faker->boolean,
        'stapled' => $faker->boolean,
        'paper_size' => $faker->randomElement([3, 4]),
        'paper_type' => $faker->randomElement([1, 2, 3]),
        'file' => $faker->name,
        'printer_id' => 1,
        'satisfaction_grade' => $faker->randomElement(['1', '2', '3']),
    ];
});
