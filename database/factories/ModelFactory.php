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

    static $name = 'guest';
    static $username = 'guest';
    static $email = 'guest@mail.com';
    static $super_user = 0;

    return [
        'name' => $name,
//        'email' => $faker->unique()->safeEmail,
        'email' => $email,
        'super_user' => $super_user,
        'username' => $username,
        'password' => $password ?: $password = bcrypt('password'),
        'remember_token' => str_random(10),
    ];
});
