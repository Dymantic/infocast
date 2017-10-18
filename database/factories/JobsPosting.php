<?php

use Faker\Generator as Faker;

$factory->define(\App\Careers\Posting::class, function (Faker $faker) {
    return [
        'title' => $faker->jobTitle,
        'type' => $faker->randomElement(['Full Time', 'Part Time', 'Contact Work']),
        'category' => $faker->randomElement(['Management', 'Engineering', 'Janitorial']),
        'location' => $faker->city,
        'compensation' => 'NT$88,888 per month',
        'posted' => \Illuminate\Support\Carbon::parse('-3 days'),
        'start_date' => \Illuminate\Support\Carbon::parse('+10 days'),
        'introduction' => $faker->paragraph,
        'job_description' => $faker->paragraph,
        'responsibilities' => $faker->paragraph,
        'requirements' => $faker->paragraph
    ];
});
