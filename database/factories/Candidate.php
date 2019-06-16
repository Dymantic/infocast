<?php

use Faker\Generator as Faker;

$factory->define(\App\Careers\Candidate::class, function (Faker $faker) {
    $application = factory(\App\Careers\Application::class)->create();
    return [
        'first_name' => $application->first_name,
        'last_name' => $application->last_name,
        'email' => $application->email,
        'phone' => $application->phone,
        'application_id' => $application->id
    ];
});
