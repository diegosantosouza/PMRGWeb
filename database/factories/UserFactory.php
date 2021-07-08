<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->firstNameMale,
        're' => $faker->numberBetween($min = 100000, $max = 190000),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => \Illuminate\Support\Facades\Hash::make(123456789), // password
        'ativo' => $faker->randomElement($array = array ('1','0')),
        'admin' => $faker->randomElement($array = array ('1','0')),
        'penal' => $faker->randomElement($array = array ('1','0')),
        'labor' => $faker->randomElement($array = array ('1','0')),
        'juridica' => $faker->randomElement($array = array ('1','0')),
        'pjmd' => $faker->randomElement($array = array ('1','0')),
        'escolta' => $faker->randomElement($array = array ('1','0')),
        'guarda' => $faker->randomElement($array = array ('1','0')),
        'naps' => $faker->randomElement($array = array ('1','0')),
        'uis' => $faker->randomElement($array = array ('1','0')),
        'p2' => $faker->randomElement($array = array ('1','0')),
        'secao' => $faker->randomElement($array = array ('penal', 'labor', 'juridica', 'pjmd', 'escolta', 'guarda', 'naps', 'uis', 'p2')),
        'remember_token' => Str::random(10),
    ];
});
