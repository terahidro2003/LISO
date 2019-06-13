<!-- <?php

$factory->define(App\Entrie::class, function (Faker\Generator $faker) {
    return [
        'RFID' => $faker->randomNumber(),
        'Owner' => $faker->randomNumber(),
    ];
});

$factory->define(App\Fees::class, function (Faker\Generator $faker) {
    return [
        'price' => $faker->randomNumber(),
        'owner' => $faker->randomNumber(),
    ];
});

$factory->define(App\groups::class, function (Faker\Generator $faker) {
    return [
        'groupName' => $faker->word,
        'description' => $faker->word,
        'leader' => $faker->word,
        'memberCount' => $faker->randomNumber(),
    ];
});

$factory->define(App\paymentStatistics::class, function (Faker\Generator $faker) {
    return [
        'range' => $faker->word,
        'balance' => $faker->randomNumber(),
        'fees' => $faker->randomNumber(),
        'payments' => $faker->randomNumber(),
        'deptors' => $faker->randomNumber(),
        'month' => $faker->randomNumber(),
        'year' => $faker->randomNumber(),
    ];
});

$factory->define(App\Signups::class, function (Faker\Generator $faker) {
    return [
        'firstName' => $faker->word,
        'lastName' => $faker->word,
        'primaryPhone' => $faker->word,
        'birthDate' => $faker->date(),
        'city' => $faker->city,
    ];
});

$factory->define(App\Statistics::class, function (Faker\Generator $faker) {
    return [
    ];
});

$factory->define(App\update::class, function (Faker\Generator $faker) {
    return [
        'version' => $faker->word,
        'type' => $faker->word,
        'part' => $faker->word,
        'description' => $faker->word,
        'developer' => $faker->word,
        'problemsSolved' => $faker->word,
        'improved' => $faker->word,
    ];
});

$factory->define(App\dancer::class, function (Faker\Generator $faker) {
    return [
        'signupID' => $faker->randomNumber(),
        'firstName' => $faker->name,
        'lastName' => $faker->lastName,
        'birthDate' => $faker->date(),
        'primaryPhone' => $faker->randomNumber(),
        'city' => $faker->word,
        'facebook' => $faker->word,
        'instagram' => $faker->word,
        'description' => $faker->word,
        'group' => $faker->word,
        'group' => 30,
        'VIP' => false,
        'currentLock' => 0,
        'email' => $faker->safeEmail,
        'secondaryPhone' => $faker->randomNumber(),
    ];
});

$factory->define(App\UserSessions::class, function (Faker\Generator $faker) {
    return [
    ];
});
