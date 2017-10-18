<?php

use Faker\Generator as Faker;

$factory->define(\App\Careers\Application::class, function (Faker $faker) {
    return [
        'posting_id' => function() {
            return factory(\App\Careers\Posting::class)->create()->id;
        },
        'first_name'       => $faker->firstName,
        'last_name'        => $faker->lastName,
        'email'            => $faker->email,
        'phone'            => $faker->phoneNumber,
        'contact_method'   => $faker->randomElement(['email', 'phone']),
        'gender'           => $faker->randomElement(['male', 'female']),
        'date_of_birth'    => '01/01/1980',
        'prev_company'     => $faker->company,
        'prev_position'    => $faker->jobTitle,
        'university'       => 'Varsity College',
        'qualifications'   => 'BA SocSci',
        'skills'           => $faker->paragraph,
        'english_ability'  => $faker->randomElement(['poor', 'intermediate', 'excellent']),
        'mandarin_ability' => $faker->randomElement(['poor', 'intermediate', 'excellent']),
        'notes'            => $faker->paragraph
    ];
});
