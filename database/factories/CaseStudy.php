<?php

use Faker\Generator as Faker;

$factory->define(\App\CaseStudies\CaseStudy::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'time_period' => \Illuminate\Support\Carbon::today()->subYear()->year,
        'project_type' => $faker->words(2, true),
        'client' => $faker->company,
        'body' => $faker->paragraph
    ];
});
