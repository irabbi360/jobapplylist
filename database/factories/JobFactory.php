<?php

use Faker\Generator as Faker;

$factory->define(App\Job::class, function (Faker $faker) {
    return [
        'title' => $faker->jobTitle,
        'apply_date' => \Carbon\Carbon::now(),
        'info' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        'user_id' => App\User::all()->random()->id,
    ];
});
