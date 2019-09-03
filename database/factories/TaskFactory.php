<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {

    return [
        'caption' => $faker->jobTitle,
        'description' => $faker->text,
        'isPublished' => false,
        'user_id' => round(rand(2,3)),
    ];
});
