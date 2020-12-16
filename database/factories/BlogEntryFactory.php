<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\BlogEntry;
use Faker\Generator as Faker;

$factory->define(BlogEntry::class, function (Faker $faker) {
    return [
        // creates User to BlogEntry using UserFactory
        'user_id' => factory(\App\User::class),

        //creates headline using Faker 
        'headline' => $faker->sentence,

        //creates content using Faker
        'content' => $faker->paragraph,

        //set image url 
        'img_url' => '/img/image-2_1607505758.png'
    ];
});
