<?php

use Faker\Generator as Faker;

$factory->define(App\Signups::class, function (Faker $faker) {
    return [
        'firstName' => $faker->firstName,
        'lastName' => $faker->lastName,
        'primaryPhone' => $faker->e164PhoneNumber,
        'birthDate' => $faker->date($format = 'Y-m-d', $max = '2010-01-01'),
        'city' => 'Klaipeda'
    ];
});
