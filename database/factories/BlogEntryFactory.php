<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\BlogEntry;
use Faker\Generator as Faker;

$factory->define(BlogEntry::class, function (Faker $faker) {
    return [
        'user_id' => factory(\App\User::class),
        'headline' => $faker->word,
        'content' => $faker->paragraph,
        'img_url' => '/img/image-2_1607505758.png'
    ];
});
